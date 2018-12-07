<?php

namespace App\Retrievers;

use OpenCage\Geocoder\Geocoder;
use Illuminate\Support\Facades\Cache;

class GeoRetriever
{
    private $geoCoder;
    private $apiKey = 'c0786d1b1f034b4b8b9e75b78aa92d0f';
    private $cacheValidityPeriod = 60 * 24 * 30;                // Minutes data in cache considered valid

    public function __construct()
    {
        $this->geoCoder = new Geocoder($this->apiKey);
    }

    public function getGeoLocation($address)
    {
        $address = trim($address);

        // Use cached data if we already have it
        $geoData = Cache::get('geo-data-' . $address);

        // If not, get fresh data from API
        if (!$geoData) {
            $geoData = $this->doGetGeoLocation($address);
            if ($geoData) {
                // Store fresh data to cache
                Cache::put('geo-data-' . $address, $geoData, $this->cacheValidityPeriod);
            }
        }

        return $geoData;
    }

    private function doGetGeoLocation($address)
    {
        try {
            $result = $this->geoCoder->geocode($address);
            if ($result && $result['total_results'] > 0) {
                $firstResult = $result['results'][0];
                return [
                    'lat'           => $firstResult['geometry']['lat'],
                    'lon'           => $firstResult['geometry']['lng'],
                    'description'   => $firstResult['formatted']
                ];
            }
        } catch (\Exception $e) {

        }
        return false;
    }

    public function getAddress($latitude, $longitude)
    {
        // Use cached data if we already have it
        $geoData = Cache::get('geo-data-' . $latitude . '-' . $longitude);

        // If not, get fresh data from API
        if (!$geoData) {
            $geoData = $this->doGetAddress($latitude, $longitude);
            if ($geoData) {
                // Store fresh data to cache
                Cache::put('geo-data-' . $latitude . '-' . $longitude, $geoData, $this->cacheValidityPeriod);
            }
        }

        return $geoData;
    }

    private function doGetAddress($latitude, $longitude)
    {
        try {
            $result = $this->geoCoder->geocode($latitude . ',' . $longitude);
            if ($result && $result['total_results'] > 0) {
                $firstResult = $result['results'][0];
                return [
                    'lat'           => $firstResult['geometry']['lat'],
                    'lon'           => $firstResult['geometry']['lng'],
                    'description'   => $firstResult['formatted']
                ];
            }
        } catch (\Exception $e) {

        }
        return false;
    }
}