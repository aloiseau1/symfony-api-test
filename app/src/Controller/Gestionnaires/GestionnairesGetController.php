<?php

namespace App\Controller\Gestionnaires;

use App\Entity\Gestionnaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GestionnairesGetController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/gestionnaires', name: 'app_gestionnaires_get', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $gestionnaireRepository = $this->entityManager->getRepository(Gestionnaire::class);
        $gestionnaires = $gestionnaireRepository->findAll();

        return $this->json($gestionnaires);
    }
}
