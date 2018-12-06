<?php

namespace App\Retrievers;

use Illuminate\Support\Facades\Cache;

class MeteoRetriever
{
    private $apiUrl = 'https://api.met.no/weatherapi/locationforecast/1.9/';
    private $cacheValidityPeriod = 5;                           // Minutes data in cache considered valid

    public function getMeteoData($latitude, $longitude)
    {
        $latitude = (float) $latitude;
        $longitude = (float) $longitude;

        // Use cached data if we already have it
        $meteoData = Cache::get('meteo-data-' . $latitude . '-' . $longitude);

        // If not, get fresh data from API
        if (!$meteoData) {
            $meteoData = $this->doGetMeteoData($latitude, $longitude);
            if ($meteoData) {
                // Store fresh data to cache
                Cache::put('meteo-data-' . $latitude . '-' . $longitude, $meteoData, $this->cacheValidityPeriod);
            }
        }

        return $meteoData;
    }

    private function doGetMeteoData($latitude, $longitude)
    {
        try {
            $guzzle = new \GuzzleHttp\Client();
            $res = $guzzle->request('GET', $this->apiUrl, [
                'query' => [
                    'lat' => $latitude,
                    'lon' => $longitude
                    ]
            ]);
            $apiData = $res->getBody();

        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return false;
        }

        return $this->parseMeteoXML($apiData);
    }

    private function parseMeteoXML($rawData)
    {
        $fullData = new \SimpleXMLElement($rawData);

        // Use latest weather readings for temperature, humidity, clouds...
        // I.e. index 0 of xml chronological data
        $latestWeatherReadings = $fullData->product[0]->time[0]->location;

        // Use latest - 1 readings to get main symbol, such as sun or cloud
        // (api do not send the symbol in latest readings)
        // I.e. index 1 of xml chronological data
        $prevWeatherReadings = $fullData->product[0]->time[1]->location;

        $meteoData = [
            'dew_point'     => (string) $latestWeatherReadings->dewpointTemperature['value'],
            'humidity'      => (string) $latestWeatherReadings->humidity['value'],
            'temperature'   => (string) $latestWeatherReadings->temperature['value'],
            'fog'           => (string) $latestWeatherReadings->fog['percent'],
            'low_clouds'    => (string) $latestWeatherReadings->lowClouds['percent'],
            'medium_clouds' => (string) $latestWeatherReadings->mediumClouds['percent'],
            'high_clouds'   => (string) $latestWeatherReadings->highClouds['percent'],
            'symbol'        => (string) $prevWeatherReadings->symbol['id']
        ];

        return $meteoData;
    }

}