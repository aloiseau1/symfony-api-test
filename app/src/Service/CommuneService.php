<?php

namespace App\Service;

use App\Client\GeogouvClient;
use App\Entity\Commune;

class CommuneService
{
    private GeogouvClient $geogouvClient;

    public function __construct(
        GeogouvClient $geogouvClient
    ) {
        $this->geogouvClient = $geogouvClient;
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

    /**
     * @return Commune[]
     */
    public function getCommunes(): array
    {
        return $this->geogouvClient->fetchCommunes();
    }
}
