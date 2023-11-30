<?php

namespace App\Client;

use App\Entity\Response\Weather\WeatherResponse;
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
        return $this->execute('GET', sprintf('/VisualCrossingWebServices/rest/services/timeline/%s', $location), WeatherResponse::class, $query);
    }

    private function execute(string $method, string $uri, ?string $responseType = null, ?array $query = [], ?array $headers = []): mixed
    {
        $options = [
            'base_uri' => $this->apiurl,
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => [
                'key' => $this->apikey
            ]
        ];

        if ($query) {
            $options['query'] = array_merge($options['query'], $query);
        }

        if ($headers) {
            $options['headers'] = array_merge($options['headers'], $query);
        }

        $response = $this->httpClient->request($method, $uri, $options);

        if ($responseType) {
            return $this->serializer->deserialize($response->getContent(), $responseType, 'json');
        }

        return $response->getContent();
    }
}
