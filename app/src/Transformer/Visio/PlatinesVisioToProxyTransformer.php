<?php

namespace App\Transformer\Visio;

use App\Entity\Platine;
use App\Entity\Request\PlatinesVisio\PlatinesVisioRequest;
use Symfony\Component\Serializer\SerializerInterface;

class PlatinesVisioToProxyTransformer
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) {
    }

    public function transform(PlatinesVisioRequest $platinesVisioRequest): Platine
    {
        $platineData = [
            'code' => $platinesVisioRequest->CODE_PLATINE,
            'name' => $platinesVisioRequest->NOM_PLATINE,
            'number' => $platinesVisioRequest->NUM_PLATINE,
            'serialNumber' => $platinesVisioRequest->PLA_SERIALNUM,
        ];

        return $this->serializer->deserialize(json_encode($platineData), Platine::class, 'json');
    }


    public function reverseTransform(Platine $platine): PlatinesVisioRequest
    {
        $platineData = [
            'CODE_PLATINE' => $platine->getCode(),
            'NOM_PLATINE' => $platine->getName(),
            'NUM_PLATINE' => $platine->getNumber(),
            'PLA_SERIALNUM' => $platine->getSerialNumber(),
        ];

        return $this->serializer->deserialize(json_encode($platineData), PlatinesVisioRequest::class, 'json');
    }
}