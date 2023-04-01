<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiircuitController extends AbstractController
{
    #[Route('/siircuit', name: 'app_siircuit')]
    public function index(): Response
    {
        return $this->render('siircuit/index.html.twig', [
            'controller_name' => 'SiircuitController',
        ]);
    }
}
