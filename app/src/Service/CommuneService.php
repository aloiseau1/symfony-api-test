<?php

namespace App\Service;

use App\Client\GeogouvClient;
use App\Entity\Commune;
use Symfony\Component\Serializer\SerializerInterface;

class CommuneService
{
    private GeogouvClient $geogouvClient;
    private SerializerInterface $serializer;

    public function __construct(
        GeogouvClient $geogouvClient,
        SerializerInterface $serializer
    ) {
        $this->geogouvClient = $geogouvClient;
        $this->serializer = $serializer;
    }

    public function getCommuneByZipCode(string $zipCode): ?Commune
    {
        $communes = $this->geogouvClient->fetchCommuneByZipCode($zipCode);

        return $communes[0] ?? null;
    }

    public function getCommuneByCode(string $code): ?Commune
    {
        return $this->geogouvClient->fetchCommuneByCode($code);
    }

    public function getCommunes(): \Generator
    {
        $communes = $this->geogouvClient->fetchCommunes();

        $count = 0;
        foreach ($communes  as $value) {
            yield $this->serializer->normalize($value);

            ++$count;
            if ($count % 500 === 0) {
                flush();
            }
        }
    }
}
