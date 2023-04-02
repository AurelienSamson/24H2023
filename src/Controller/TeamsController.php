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
            'teams' => $teams
        ]);
    }
}
