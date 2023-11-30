<?php

namespace App\Controller\Badges;

use App\Entity\Badge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BadgesPostController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/badges', name: 'app_badges_post', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $requestContent = $request->getContent();
        $request = json_decode($requestContent, true);
        $badge = new Badge();
        $badge->setNom($request['nom']);
        $badge->setType($request['type']);
        $badge->setPrenom($request['prenom']);
        $badge->setCodeGravure($request['code_gravure']);
        $this->entityManager->persist($badge);
        $this->entityManager->flush();

        return $this->json(['id' => $badge->getId()]);
    }
}
