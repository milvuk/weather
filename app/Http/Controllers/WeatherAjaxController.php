<?php

namespace App\Http\Controllers;

use App\Retrievers\GeoRetriever;
use App\Retrievers\MeteoRetriever;
use App\Weather;
use Illuminate\Support\Facades\Input;

class WeatherAjaxController extends Controller
{
    public function checkWeather()
    {
        $departureAddress = trim(Input::get('dep_address'));
        $departureLatitude = trim(Input::get('dep_lat'));
        $departureLongitude = trim(Input::get('dep_lon'));

        $destinationAddress = trim(Input::get('dest_address'));
        $destinationLatitude = trim(Input::get('dest_lat'));
        $destinationLongitude = trim(Input::get('dest_lon'));

        $departureWeather = new Weather($departureLatitude, $departureLongitude, $departureAddress);
        $departureData = $departureWeather->getWeatherData();

        if (!$departureData['status']) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Departure: ' . $departureData['message']
            ]);
        }

        $destinationWeather = new Weather($destinationLatitude, $destinationLongitude, $destinationAddress);
        $destinationData = $destinationWeather->getWeatherData();

        if (!$destinationData['status']) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Destination: ' . $destinationData['message']
            ]);
        }

        return response()->json([
            'status'        => 'ok',
            'message'       => '',
            'departure'     => $departureData,
            'destination'   => $destinationData
        ]);
    }


}