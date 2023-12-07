<?php

namespace App\Controller\Gestionnaires;

use App\Entity\Gestionnaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class GestionnairesPostController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/gestionnaires', name: 'app_gestionnaires_post', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] Gestionnaire $gestionnaire): Response
    {
        $this->entityManager->persist($gestionnaire);
        $this->entityManager->flush();

        return $this->json(['id' => $gestionnaire->getId()]);
    }
}
