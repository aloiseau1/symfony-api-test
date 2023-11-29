<?php

namespace App\Entity\Response;

class WeatherResponse
{
    public float $latitude;
    public float $longitude;
    public string $resolvedAddress;
    public string $description;
    /**
     * @var WeatherDaysResponse[]
     */
    public array $days;
}
