<?php

namespace App\Controller\Badges;

use App\Entity\Badge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/badges', name: 'app_badges_get', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $badgeRepository = $this->entityManager->getRepository(Badge::class);
        $badges = $badgeRepository->findAll();

        $badgeResponse = [];
        foreach ($badges as $badge) {
            $badgeResponse[] = [
                'id' => $badge->getId(),
                'nom' => $badge->getNom(),
                'prenom' => $badge->getPrenom(),
                'codeGravure' => $badge->getCodeGravure(),
            ];
        }

        return $this->json($badgeResponse);
    }
}
