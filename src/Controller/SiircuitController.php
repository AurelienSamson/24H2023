<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;
use App\Service\ApiRestService;

class SiircuitController extends AbstractController
{
    public function __construct(public ApiRestService $api) {
        $this->api = $api;
    }

    #[Route('/siircuit', name: 'app_siircuit')]
    public function index(): Response
    {

        $listCircuit = $this->api->CallRaces(url:'all', teamId:21);

        //dd($listCircuit);
        

        // Parcourez les fichiers et affichez-les un par un
        $imagesOffi = [];
        foreach($listCircuit as $circuit) {
            if ($circuit->optional == false) {
                $circuit_offi = new Circuit;
                $circuit_offi->setImage($circuit->image);
                $circuit_offi->setName($circuit->name);
                $circuit_offi->setTours($circuit->laps);
                foreach ($circuit->sections as $section) {
                    $circuit_offi->addSection($section->terrain, $section->type);
                }
                $circuit_offi->getTimeAllLaps();
                $imagesOffi []= $circuit_offi;
            }
                
        
        }





        return $this->render('siircuit/index.html.twig', [
            'controller_name' => 'SiircuitController',
            'images_circuit_offi' => $imagesOffi
        ]);
    }
}
