<?php

namespace App\Controller\Weather;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WeatherGetController extends AbstractController
{
    private WeatherService $weatherService;

    public function __construct(
        WeatherService $weatherService
    ) {
        $this->weatherService = $weatherService;
    }

    #[Route('/weather', name: 'app_weather_get', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $location = $request->get('location');
        $unitGroup = $request->get('unitGroup');

        $weather = $this->weatherService->getWeatherData($location, $unitGroup);

        return $this->json($weather);
    }
}
