<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;


class WeatherService
{
    private Client $client;
    private string $apiKey;
    private string $baseurl = "https://api.openweathermap.org/";

    private array $gotError =  ['error' => "Unknown data"];
    private array $notFound =  ['error' => "City not found"];
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('OPENWEATHERMAP_KEY');
    }


    public function getWeatherData($city)
    {
        try {
            $response = $this->client->get("{$this->baseurl}data/2.5/weather?q={$city}&appid={$this->apiKey}&units=metric");

            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() == 404) {
                return $this->notFound;
            }

            Log::error("Error in fetch weather", [
                'code' => $e->getResponse()->getStatusCode(),
                'body' => $e->getResponse()->getBody(),
                'exception' => $e
            ]);
            return $this->gotError;

        }
    }
}
