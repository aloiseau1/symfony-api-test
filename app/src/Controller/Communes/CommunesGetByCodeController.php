<?php

namespace App\Controller\Communes;

use App\Entity\Commune;
use App\Service\CommuneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CommunesGetByCodeController extends AbstractController
{
    private CommuneService $communeService;

    public function __construct(
        CommuneService $communeService
    ) {
        $this->communeService = $communeService;
    }

    public function __invoke(string $code): ?Commune
    {
        return $this->communeService->getCommuneByCode($code);
    }
}
