<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnemenController extends AbstractController
{
    #[Route('/abonnemen', name: 'app_abonnemen')]
    public function index(): Response
    {
        return $this->render('abonnemen/index.html.twig', [
            'controller_name' => 'AbonnemenController',
        ]);
    }
}
