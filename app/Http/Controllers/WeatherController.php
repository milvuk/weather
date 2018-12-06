<?php

namespace App\Http\Controllers;

use App\Retrievers\GeoRetriever;
use App\Retrievers\MeteoRetriever;

class WeatherController extends Controller
{
    public function index()
    {
        $geoRetriever = new GeoRetriever();
        $meteoRetriever = new MeteoRetriever();

        //$rez = $geoRetriever->getGeoLocation('Banja Luka');

        $rez = $meteoRetriever->getMeteoData('44.7719817', '17.1898929');

        var_dump($rez);
    }
}