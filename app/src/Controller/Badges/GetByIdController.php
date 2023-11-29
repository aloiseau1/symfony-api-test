<?php

namespace App\Controller\Badges;

use App\Entity\Badge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetByIdController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/badges/{id}', name: 'app_badges_get_by_id', methods: ['GET'])]
    public function __invoke(int $id): Response
    {
        $badgeRepository = $this->entityManager->getRepository(Badge::class);
        $badge = $badgeRepository->find($id);

        $badgeResponse = [
            'id' => $badge->getId(),
            'nom' => $badge->getNom(),
            'prenom' => $badge->getPrenom(),
            'codeGravure' => $badge->getCodeGravure(),
        ];

        return $this->json($badgeResponse);
    }
}
