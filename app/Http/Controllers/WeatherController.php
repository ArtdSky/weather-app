<?php

namespace App\Http\Controllers;

use App\Repositories\WeatherRepository;
use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private WeatherService $weatherService;
    private WeatherRepository $weatherRepository;

    public function __construct(WeatherService $weatherService, WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
        $this->weatherService = $weatherService;
    }


    public function index()
    {
        return view('weather.index');
    }


    public function fetchWeather(Request $request): JsonResponse
    {
        $city = $request->input('city');
        $data = $this->weatherRepository->get($city);

        if (!$data) {
            $data = $this->weatherService->getWeatherData($city);
            $this->weatherRepository->put($city, $data);
        }

        return response()->json($data);
    }

}
