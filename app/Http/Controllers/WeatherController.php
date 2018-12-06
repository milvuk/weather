<?php

namespace App\Http\Controllers;

use App\Retrievers\GeoRetriever;

class WeatherController extends Controller
{
    public function index()
    {
        $geoRetriever = new GeoRetriever();

        $rez = $geoRetriever->getGeoLocation('Banja Luka');

        var_dump($rez);
    }
}