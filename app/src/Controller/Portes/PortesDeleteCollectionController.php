<?php

namespace App\Controller\Portes;

use App\Entity\Porte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PortesDeleteCollectionController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): Response
    {
        $porteRepository = $this->entityManager->getRepository(Porte::class);
        $portes = $porteRepository->findByLatestInsert();

        foreach ($portes as $porte) {
            $this->entityManager->remove($porte);
        }
        $this->entityManager->flush();

        $response = new Response();
        $response->setStatusCode(204);
        return $response;
    }
}
