<?php

namespace App\Service;

use App\Client\InseeClient;
use App\Entity\Response\Insee\InseeSirenResponse;

class InseeService
{
    private InseeClient $inseeClient;

    public function __construct(
        InseeClient $inseeClient
    ) {
        $this->inseeClient = $inseeClient;
    }

    public function getCompanyBySiren(string $siren): InseeSirenResponse
    {
        return $this->inseeClient->fetchCompanyBySiren($siren);
    }
}
