<?php

namespace App\Entity\Response\Weather;

class WeatherDaysResponse
{
    public string $datetime;
    public float $tempmax;
    public float $tempmin;
    public float $temp;
    public string $description;
    /**
     * @var WeatherDaysHoursResponse[]
     */
    public array $hours;
}
