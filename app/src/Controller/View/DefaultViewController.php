<?php

namespace App\Controller\View;

use App\Service\CommuneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultViewController extends AbstractController
{
    #[Route('/default/view', name: 'app_default_view', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('default/view.html.twig', []);
    }
}
