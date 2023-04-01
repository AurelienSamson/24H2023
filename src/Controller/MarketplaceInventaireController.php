<?php

namespace App\Controller;

use App\Service\ApiRestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketplaceInventaireController extends AbstractController
{
    public function __construct(public ApiRestService $api) {
        $this->api = $api;
    }

    #[Route('/marketplace_inventaire', name: 'app_marketplace_inventaire')]
    public function index(): Response
    {

        $team = $this->api->CallTeams(methode:'GET', teamId:21);

        dd($teams);

        return $this->render('marketplace_inventaire/index.html.twig', [
            "statsVoiture"=> [
                ["puissance", $team->vehicule->power],
                ["accélération", $team->vehicule->acceleration],
                ["adhérence", $team->vehicule->grip],
                ["maniabilité", $team->vehicule->handlingAbility],
                ["consommation", $team->vehicule->energyConsumption],
                ["usure", $team->vehicule->wear],
                ["poids", $team->vehicule->weight],
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
