<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{


    public function index(){
        return view('weather.index');
    }


    public function fetchWeather(Request $request)
    {
        $city = $request->input('city');
        $apiKey = env('OPENWEATHERMAP_KEY');

        $client = new Client();
        $response = $client->get("http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");
        $data = json_decode($response->getBody(), true);
        return response()->json($data);
    }

}
