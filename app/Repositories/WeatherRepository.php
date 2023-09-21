<?php

namespace App\Repositories;


use Illuminate\Support\Facades\Cache;

class WeatherRepository
{
    public function get($city)
    {
        return Cache::get($city);
    }

    public function put($city, $data)
    {
        return Cache::put($city, $data, 3600);
    }

}
