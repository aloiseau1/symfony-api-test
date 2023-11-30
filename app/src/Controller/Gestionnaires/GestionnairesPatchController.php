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

class GestionnairesPatchController extends AbstractController
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

    #[Route('/gestionnaires/{id}', name: 'app_gestionnaires_patch', methods: ['PATCH'])]
    public function __invoke(int $id, Request $request): Response
    {
        $gestionnaireRepository = $this->entityManager->getRepository(Gestionnaire::class);
        $gestionnaire = $gestionnaireRepository->find($id);

        $newGestionnaire = $this->serializer->deserialize($request->getContent(), Gestionnaire::class, 'json', ['object_to_populate' => $gestionnaire]);

        $errors = $this->validator->validate($newGestionnaire);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        $this->entityManager->persist($newGestionnaire);
        $this->entityManager->flush();

        return $this->json($gestionnaire);
    }
}
