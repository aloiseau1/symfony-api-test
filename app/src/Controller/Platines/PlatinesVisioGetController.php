<?php

namespace App\Controller\Platines;

use App\Entity\Platine;
use App\Transformer\Visio\PlatinesVisioToProxyTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class PlatinesVisioGetController extends AbstractController
{
    private PlatinesVisioToProxyTransformer $platinesVisioToProxyTransformer;

    public function __construct(
        PlatinesVisioToProxyTransformer $platinesVisioToProxyTransformer
    ) {
        $this->platinesVisioToProxyTransformer = $platinesVisioToProxyTransformer;
    }

    public function __invoke(Platine $platine): JsonResponse
    {
        $platineVisio = $this->platinesVisioToProxyTransformer->reverseTransform($platine);

        return $this->json($platineVisio);
    }
}
