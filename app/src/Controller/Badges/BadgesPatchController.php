<?php

namespace App\Controller\Badges;

use App\Entity\Badge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BadgesPatchController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/badges/{id}', name: 'app_badges_patch', methods: ['PATCH'])]
    public function __invoke(int $id, Request $request): JsonResponse
    {
        $badgeRepository = $this->entityManager->getRepository(Badge::class);
        $badge = $badgeRepository->find($id);

        $requestContent = $request->getContent();
        $request = json_decode($requestContent, true);

        if (isset($request['nom'])) {
            $badge->setNom($request['nom']);
        }

        if (isset($request['prenom'])) {
            $badge->setNom($request['prenom']);
        }

        if (isset($request['code_gravure'])) {
            $badge->setNom($request['code_gravure']);
        }

        if (isset($request['type'])) {
            $badge->setNom($request['type']);
        }
        $this->entityManager->flush();

        $badgeResponse = [
            'id' => $badge->getId(),
            'nom' => $badge->getNom(),
            'prenom' => $badge->getPrenom(),
            'codeGravure' => $badge->getCodeGravure(),
        ];

        return $this->json($badgeResponse);
    }
}
