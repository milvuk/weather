<?php

namespace App;

use App\Retrievers\GeoRetriever;
use App\Retrievers\MeteoRetriever;

class Weather
{
    private $latitude;
    private $longitude;
    private $address;

    private $getByLatLon = false;

    private $geoRetriever;
    private $meteoRetriever;

    public function __construct($latitude='', $longitude='', $address='')
    {
        if ($this->isValidLatitude($latitude) && $this->isValidLongitude($longitude)) {
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->getByLatLon = true;
        }
        $this->address = $address;
        $this->geoRetriever = new GeoRetriever();
        $this->meteoRetriever = new MeteoRetriever();
    }

    public function getWeatherData()
    {
        if ($this->getByLatLon) {
            $address = $this->geoRetriever->getAddress($this->latitude, $this->longitude);
            if ($address) {
                $this->address = $address['description'];
            }
            return $this->getWeatherDataByLatLon();
        }
        return $this->getWeatherDataByAddress();
    }

    private function getWeatherDataByLatLon()
    {
        $weatherData = $this->meteoRetriever->getMeteoData($this->latitude, $this->longitude);
        if ($weatherData) {
            return [
                'status'    => true,
                'message'   => '',
                'geo'       => [
                    'latitude'  => $this->latitude,
                    'longitude' => $this->longitude,
                    'address'   => $this->address
                ],
                'meteo'     => $weatherData
            ];
        }
        return [
            'status'        => false,
            'message'       => 'Error getting weather data from API.'
        ];
    }

    private function getWeatherDataByAddress()
    {
        if (empty($this->address) || strlen($this->address) < 2) {
            return [
                'status'    => false,
                'message'   => 'Invalid address given.'
            ];
        }

        $geoData = $this->geoRetriever->getGeoLocation($this->address);
        if ($geoData) {
            $this->latitude = $geoData['lat'];
            $this->longitude = $geoData['lon'];
            $this->address = $geoData['description'];
            return $this->getWeatherDataByLatLon();
        }
        return [
            'status'    => false,
            'message'   => 'Cannot find geographical coordinates for given address.'
        ];
    }

    private function isValidLatitude($latitude)
    {
        return is_numeric($latitude) && ($latitude >= -90.0 && $latitude <= 90.0);
    }

    private function isValidLongitude($longitude)
    {
        return is_numeric($longitude) &&  ($longitude >= -180.0 && $longitude <= 180.0);
    }
}