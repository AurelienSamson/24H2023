<?php

namespace App\Controller;

use App\Service\ApiRestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    public $api;
    public function __construct(ApiRestService $api) {
        $this->api = $api;
    }

    #[Route('/test', name: 'app_test')]
    public function index()
    {
        $teams = $this->api->CallTeams();

        dd($teams);
        return $this->render('test/index.html.twig', [
            'teams' => $teams,
        ]);
    }
}
