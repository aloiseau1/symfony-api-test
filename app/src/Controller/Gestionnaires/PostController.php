<?php

namespace App\Controller\Gestionnaires;

use App\Entity\Gestionnaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostController extends AbstractController
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

    #[Route('/gestionnaires', name: 'app_gestionnaires_post', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $gestionnaire = $this->serializer->deserialize($request->getContent(), Gestionnaire::class, 'json');

        $errors = $this->validator->validate($gestionnaire);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        $this->entityManager->persist($gestionnaire);
        $this->entityManager->flush();

        return $this->json(['id' => $gestionnaire->getId()]);
    }
}
