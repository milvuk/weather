<?php

namespace App\Http\Controllers;

use \OpenCage\Geocoder\Geocoder;

class WeatherController extends Controller
{
    public function index()
    {
        $geocoder = new Geocoder('c0786d1b1f034b4b8b9e75b78aa92d0f');
        $result = $geocoder->geocode('Banja Luka');
        var_dump($result);
        //echo 'tu smo!';

    }
}