<?php

namespace App\Client;

use App\Entity\Response\Insee\InseeSirenResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InseeClient
{
    private string $apiurl;
    private string $apikey;
    private HttpClientInterface $httpClient;
    private SerializerInterface $serializer;

    public function __construct(
        string $apiurl,
        string $apikey,
        HttpClientInterface $httpClient,
        SerializerInterface $serializer
    ) {
        $this->apiurl = $apiurl;
        $this->apikey = $apikey;
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    public function fetchCompanyBySiren(string $siren): InseeSirenResponse
    {
        return $this->execute('GET', sprintf('/entreprises/sirene/V3/siren/%s', $siren), InseeSirenResponse::class);
    }

    private function execute(string $method, string $baseUri, ?string $responseType = null, ?array $query = [], ?array $headers = []): mixed
    {
        $options = [
            'base_uri' => $this->apiurl,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => sprintf('Bearer %s', $this->apikey)
            ],
            'query' => []
        ];

        if ($query) {
            $options['query'] = array_merge($options['query'], $query);
        }

        if ($headers) {
            $options['headers'] = array_merge($options['headers'], $query);
        }

        $response = $this->httpClient->request($method, $baseUri, $options);

        if ($responseType) {
            return $this->serializer->deserialize($response->getContent(), $responseType, 'json');
        }

        return $response->getContent();
    }
}
