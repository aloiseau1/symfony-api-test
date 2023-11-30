<?php

namespace App\Controller\Communes;

use App\Entity\Commune;
use App\Service\CommuneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CommunesGetByZipCodeController extends AbstractController
{
    private CommuneService $communeService;

    public function __construct(
        CommuneService $communeService
    ) {
        $this->communeService = $communeService;
    }

    public function __invoke(string $zipcode): Commune
    {
        $commune = $this->communeService->getCommuneByZipCode($zipcode);

        if (!$commune) {
            throw new NotFoundHttpException('Commune not found');
        }

        return $commune;
    }
}
