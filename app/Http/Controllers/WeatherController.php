<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{


    public function index(){
        return view('weather.index');
    }


    public function fetchWeather(Request $request)
    {

        $city = $request->input('city');
        $data = Cache::get($city);
        if (!$data) {
            $apiKey = env('OPENWEATHERMAP_KEY');

            $client = new Client();
            $response = $client->get("http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");

            $data = json_decode($response->getBody(), true);

            // Сохраняем данные о погоде в кеше на 1 час
            Cache::put($city, $data, 3600);
        }

        return response()->json($data);


    }

}
