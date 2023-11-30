<?php

namespace App\Client;

use App\Entity\Commune;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeogouvClient
{
    private string $apiurl;
    private HttpClientInterface $httpClient;
    private SerializerInterface $serializer;

    public function __construct(
        string $apiurl,
        HttpClientInterface $httpClient,
        SerializerInterface $serializer
    ) {
        $this->apiurl = $apiurl;
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    /**
     * @return Commune[]
     */
    public function fetchCommuneByZipCode(?string $zipCode = null): array
    {
        $query = [
            'codePostal' => $zipCode
        ];
        return $this->execute('GET', '/communes', sprintf('%s[]', Commune::class), $query);
    }

    public function fetchCommuneByCode(string $code): Commune
    {
        return $this->execute('GET', sprintf('/communes/%s', $code), Commune::class);
    }

    /**
     * @return Commune[]
     */
    public function fetchCommunes(): array
    {
        return $this->execute('GET', '/communes', sprintf('%s[]', Commune::class));
    }

    private function execute(string $method, string $uri, ?string $responseType = null, ?array $query = [], ?array $headers = []): mixed
    {
        $options = [
            'base_uri' => $this->apiurl,
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => []
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
