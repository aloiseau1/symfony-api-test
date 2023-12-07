<?php

namespace App\Controller\Communes;

use App\Service\CommuneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedJsonResponse;

class CommunesGetController extends AbstractController
{
    private CommuneService $communeService;

    public function __construct(
        CommuneService $communeService
    ) {
        $this->communeService = $communeService;
    }

    public function __invoke(): StreamedJsonResponse
    {
        return new StreamedJsonResponse([
            'embedded' => [
                'default' => $this->communeService->getCommunes(),
            ]
        ]);
    }
}
