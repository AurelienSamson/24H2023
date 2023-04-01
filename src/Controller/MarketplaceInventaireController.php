<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketplaceInventaireController extends AbstractController
{
    #[Route('/marketplace_inventaire', name: 'app_marketplace_inventaire')]
    public function index(): Response
    {
        return $this->render('marketplace_inventaire/index.html.twig', [
            "statsVoiture"=> [
                ["puissance", 2],
                ["accélération", 0],
                ["adhérence", 0],
                ["maniabilité", 0],
                ["consommation", 0],
                ["usure", 0],
                ["poids", 0],
            ],
            "statsVoitureModifie"=> [
                ["puissance", 1],
                ["accélération", 0],
                ["adhérence", 0],
                ["maniabilité", 0],
                ["consommation", 0],
                ["usure", 0],
                ["poids", 0],
            ]
        ]);
    }
}
