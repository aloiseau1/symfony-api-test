<?php

namespace App\Controller\Gestionnaires;

use App\Entity\Gestionnaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetByIdController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/gestionnaires/{id}', name: 'app_gestionnaires_get_by_id', methods: ['GET'])]
    public function __invoke(int $id): JsonResponse
    {
        $gestionnaireRepository = $this->entityManager->getRepository(Gestionnaire::class);
        $gestionnaire = $gestionnaireRepository->find($id);

        return $this->json($gestionnaire);
    }
}
