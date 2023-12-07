<?php

namespace App\Controller\Sites;

use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SitesPatchController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;
    private ValidatorInterface $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    #[Route('/sites/{id}', name: 'app_sites_patch', methods: ['PATCH'])]
    public function __invoke(Site $site, Request $request): Response
    {
        $newSite = $this->serializer->deserialize($request->getContent(), Site::class, 'json', ['object_to_populate' => $site]);

        $errors = $this->validator->validate($newSite);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        $this->entityManager->persist($newSite);
        $this->entityManager->flush();

        return $this->json($newSite);
    }
}
