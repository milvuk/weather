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
        $departureAddress = trim(Input::get('dep-address'));
        $departureLatitude = trim(Input::get('dep-lat'));
        $departureLongitude = trim(Input::get('dep-lon'));

        $destinationAddress = trim(Input::get('dest-address'));
        $destinationLatitude = trim(Input::get('dest-lat'));
        $destinationLongitude = trim(Input::get('dest-lon'));

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