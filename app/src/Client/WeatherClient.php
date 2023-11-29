<?php

namespace App\Client;

use App\Entity\Response\WeatherResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherClient
{
    private string $apikey;
    private string $apiurl;
    private HttpClientInterface $httpClient;
    private SerializerInterface $serializer;

    public function __construct(
        string $apikey,
        string $apiurl,
        HttpClientInterface $httpClient,
        SerializerInterface $serializer
    ) {
        $this->apikey = $apikey;
        $this->apiurl = $apiurl;
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    public function fetchWeatherData(string $location, string $unitGroup): WeatherResponse
    {
        $query = [
            'unitGroup' => $unitGroup
        ];
        return $this->execute(sprintf('/VisualCrossingWebServices/rest/services/timeline/%s', $location), WeatherResponse::class, $query);
    }

    private function execute(string $baseUri, ?string $responseType = null, ?array $query = [], ?array $options = []): mixed
    {
        $defaultOptions = [
            'base_uri' => $this->apiurl,
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => [
                'key' => $this->apikey
            ]
        ];

        if ($query) {
            $defaultOptions['query'] = array_merge($defaultOptions['query'], $query);
        }

        $options = array_merge($defaultOptions, $options);
        $response = $this->httpClient->request('GET', $baseUri, $options);

        if ($responseType) {
            return $this->serializer->deserialize($response->getContent(), $responseType, 'json');
        }

        return $response->getContent();
    }
}
