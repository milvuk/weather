<?php

namespace App\Http\Controllers;

use App\Retrievers\GeoRetriever;
use App\Retrievers\MeteoRetriever;
use App\Weather;

class WeatherController extends Controller
{
    public function index()
    {

        return view('weather');
//        $geoRetriever = new GeoRetriever();
//        $meteoRetriever = new MeteoRetriever();
//
//        //$rez = $geoRetriever->getGeoLocation('Banja Luka');
//
//        $rez = $meteoRetriever->getMeteoData('44.7719817', '17.1898929');
//
//        var_dump($rez);
    }

    public function test()
    {
        $w = new Weather('44.7719817', '17.1898929');
        $data = $w->getWeatherData();
        var_dump($data);
    }
}