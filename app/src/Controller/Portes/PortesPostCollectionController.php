<?php

namespace App\Controller\Portes;

use App\Entity\Request\Portes\PortesPostCollectionRequest;
use App\Service\PorteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Serializer\SerializerInterface;

class PortesPostCollectionController extends AbstractController
{
    private SerializerInterface $serializer;
    private PorteService $porteService;

    public function __construct(
        SerializerInterface $serializer,
        PorteService $porteService
    ) {
        $this->serializer = $serializer;
        $this->porteService = $porteService;
    }

    public function __invoke(Request $request): StreamedResponse
    {
        $requestData = $this->serializer->deserialize($request->getContent(), PortesPostCollectionRequest::class, 'json');

        $response = new StreamedResponse();
        $response->headers->set('X-Accel-Buffering', 'no');

        $response->setCallback(function () use ($requestData) {
            $this->porteService->createPortes($requestData);
        });
        return $response;
    }
}
