<?php

namespace App\Service;

use App\Client\WeatherClient;
use App\Entity\Response\WeatherResponse as WeatherResponse;

class WeatherService
{
    private WeatherClient $weatherClient;

    public function __construct(
        WeatherClient $weatherClient
    ) {
        $this->weatherClient = $weatherClient;
    }

    public function getWeatherData(string $location, string $unitGroup): WeatherResponse
    {
        return $this->weatherClient->fetchWeatherData($location, $unitGroup);
    }
}
