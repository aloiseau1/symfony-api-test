<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeController extends AbstractController
{
    #[Route('/users/me', name: 'app_users_me_get', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->json($this->getUser());
    }
}
