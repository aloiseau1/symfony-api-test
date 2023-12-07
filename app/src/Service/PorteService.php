<?php

namespace App\Service;

use App\Entity\Porte;
use App\Entity\Request\Portes\PortesPostCollectionRequest;
use Doctrine\Migrations\Generator\Exception\GeneratorException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PorteService
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    public function createPortes(PortesPostCollectionRequest $portesPostCollectionRequest): void
    {
        $lastDateUpdate = new \DateTime();

        for ($porteNumber = 0; $porteNumber < $portesPostCollectionRequest->porteCount; $porteNumber++) {
            $porteData = [
                'nom' => sprintf('%s %d', $portesPostCollectionRequest->prefixName, $porteNumber),
                'comments' => $portesPostCollectionRequest->comments,
                'version' => $portesPostCollectionRequest->version,
            ];
            $porte = $this->serializer->deserialize(json_encode($porteData, true), Porte::class, 'json');
            $this->entityManager->persist($porte);
            $this->entityManager->flush();
            $currentDate = new \DateTime();

            if ($currentDate->getTimestamp() - $lastDateUpdate->getTimestamp() >= 1) {
                $progress = $porteNumber / $portesPostCollectionRequest->porteCount * 100;
                echo json_encode([
                    'progress' => $progress,
                ]);
                flush();
                $lastDateUpdate = $currentDate;
            }
        }

        echo json_encode([
            'progress' => $porteNumber / $portesPostCollectionRequest->porteCount * 100,
        ]);
        flush();
    }
}
