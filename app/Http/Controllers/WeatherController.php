<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    function index() {

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            "q" => "HaNoi",
            "appid" => "02e3323f29bc461c2346db2fe3989729"
        ] );

        $data = $response->object();
        $tempC = $data->main->temp - 273;
        $typeWeather = $data->weather[0]->main;
        $speedWind = $data->wind->speed;
        $location = $data->name;
        $humidity = $data->main->humidity;
        $icon = $data->weather[0]->icon;
        $iconWeather = "https://openweathermap.org/img/wn/$icon@4x.png";
        $currentTime = Carbon::now()->toDateTimeString();
        return view('index', compact( 'tempC',
            'typeWeather',
            'speedWind', 'location',
            'humidity', 'currentTime',
            'iconWeather'));
    }
}
