<?php

namespace App\Controller;

use App\Service\ApiRestService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamsController extends AbstractController
{
    public $itemsCategory;
    public function __construct(public ApiRestService $api) {
        $this->api = $api;
    }

    #[Route('/teams', name: 'app_teams')]
    public function index(): Response
    {
        $teams = $this->api->CallTeams();

        return $this->render('teams/index.html.twig', [
            'title' => 'Teams',
            'teams' => $teams,
            'teamId' => 21
        ]);
    }

    #[Route('/teams/inventory', name: 'app_teams_inventory')]
    public function inventory(): Response
    {
        $inventaires = $this->api->CallTeamInventory(teamId:21);

        return $this->render('teams/inventory.html.twig', [
            'title' => 'Inventaires',
            'inventaires' => $inventaires
        ]);
    }
}
