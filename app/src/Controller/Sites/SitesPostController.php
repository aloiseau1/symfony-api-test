<?php

namespace App\Controller\Sites;

use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class SitesPostController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/sites', name: 'app_sites_post', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] Site $site): Response
    {
        $this->entityManager->persist($site);
        $this->entityManager->flush();

        return $this->json(['id' => $site->getId()]);
    }
}
