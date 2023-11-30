<?php

namespace App\Controller\Sites;

use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SitesGetController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/sites', name: 'app_sites_get', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $siteRepository = $this->entityManager->getRepository(Site::class);
        $sites = $siteRepository->findAll();

        return $this->json($sites);
    }
}
