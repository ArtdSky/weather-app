<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;



Route::get('/', [WeatherController::class, 'index']);
Route::post('/fetch-weather', [WeatherController::class, 'fetchWeather'])->name('fetch.weather');
