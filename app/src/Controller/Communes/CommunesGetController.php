<?php

namespace App\Controller\Communes;

use App\Entity\Commune;
use App\Service\CommuneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommunesGetController extends AbstractController
{
    private CommuneService $communeService;

    public function __construct(
        CommuneService $communeService
    ) {
        $this->communeService = $communeService;
    }

    /**
     * @return Commune[]
     */
    public function __invoke(): array
    {
        return $this->communeService->getCommunes();
    }
}
