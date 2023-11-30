<?php

namespace App\Controller\Sites;

use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SitesGetByIdController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/sites/{id}', name: 'app_sites_get_by_id', methods: ['GET'])]
    public function __invoke(int $id): JsonResponse
    {
        $siteRepository = $this->entityManager->getRepository(Site::class);
        $siteData = $siteRepository->find($id);

        return $this->json($siteData);
    }
}
