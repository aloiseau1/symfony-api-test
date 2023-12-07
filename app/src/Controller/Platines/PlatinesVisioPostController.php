<?php

namespace App\Controller\Platines;

use App\Entity\Request\PlatinesVisio\PlatinesVisioRequest;
use App\Transformer\Visio\PlatinesVisioToProxyTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class PlatinesVisioPostController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private PlatinesVisioToProxyTransformer $platinesVisioToProxyTransformer;

    public function __construct(
        EntityManagerInterface $entityManager,
        PlatinesVisioToProxyTransformer $platinesVisioToProxyTransformer
    ) {
        $this->entityManager = $entityManager;
        $this->platinesVisioToProxyTransformer = $platinesVisioToProxyTransformer;
    }

    public function __invoke(#[MapRequestPayload] PlatinesVisioRequest $platinesVisioRequest): JsonResponse
    {
        $platine = $this->platinesVisioToProxyTransformer->transform($platinesVisioRequest);
        $this->entityManager->persist($platine);
        $this->entityManager->flush();

        return $this->json($platine);
    }
}
