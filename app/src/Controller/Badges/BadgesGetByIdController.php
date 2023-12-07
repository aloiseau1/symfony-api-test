<?php

namespace App\Controller\Badges;

use App\Entity\Badge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BadgesGetByIdController extends AbstractController
{
    #[Route('/badges/{id}', name: 'app_badges_get_by_id', methods: ['GET'])]
    public function __invoke(Badge $badge): Response
    {
        $badgeResponse = [
            'id' => $badge->getId(),
            'nom' => $badge->getNom(),
            'prenom' => $badge->getPrenom(),
            'codeGravure' => $badge->getCodeGravure(),
        ];

        return $this->json($badgeResponse);
    }
}
