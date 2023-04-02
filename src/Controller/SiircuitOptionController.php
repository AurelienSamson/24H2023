<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;
use App\Service\ApiRestService;

class SiircuitOptionController extends AbstractController
{

    public function __construct(public ApiRestService $api) {
        $this->api = $api;
    }

    
    #[Route('/siircuit/option', name: 'app_siircuit_option')]
    public function index(): Response
    {

        $listCircuit = $this->api->CallRaces(url:'all', teamId:21);

        //dd($listCircuit);

        // Parcourez les fichiers et affichez-les un par un
        $imagesOption = [];

        foreach($listCircuit as $circuit) {
            if ($circuit->optional == true) {
                $circuit_option = new Circuit;
                $circuit_option->setImage($circuit->image);
                $circuit_option->setName($circuit->name);
                $imagesOption []= $circuit_option;
            }
                
        
        }


        return $this->render('siircuit_option/index.html.twig', [
            'controller_name' => 'SiircuitOptionController',
            'images_circuit_option' => $imagesOption
        ]);
    }
}
