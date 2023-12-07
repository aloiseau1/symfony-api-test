<?php

namespace App\Controller\Gestionnaires;

use App\Entity\Gestionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GestionnairesGetByIdController extends AbstractController
{
    #[Route('/gestionnaires/{id}', name: 'app_gestionnaires_get_by_id', methods: ['GET'])]
    public function __invoke(Gestionnaire $gestionnaire): JsonResponse
    {
        return $this->json($gestionnaire);
    }
}
