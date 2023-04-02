<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;
use App\Entity\Voiture;
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
                $circuit_medals = $this->api->CallRaces(url:'run', raceId:$circuit->id, teamId:21);
                $voiture = new Voiture($circuit_medals->stats->power, $circuit_medals->stats->acceleration, $circuit_medals->stats->grip, $circuit_medals->stats->handlingAbility, $circuit_medals->stats->weight);
                $circuit_medals = $circuit_medals->medal;
                
                $circuit_offi = new Circuit;
                $circuit_offi->setImage($circuit->image);
                $circuit_offi->setName($circuit->name);
                $circuit_offi->setTours($circuit->laps);
                $circuit_offi->setMedals($circuit_medals);
                $circuit_offi->setVoiture($voiture);
                foreach ($circuit->sections as $section) {
                    $circuit_offi->addSection($section->terrain, $section->type);
                }
                $circuit_offi->getTimeAllLaps();
                $imagesOffi []= $circuit_offi;
            }
                
        
        }





        return $this->render('siircuit/index.html.twig', [
            'title' => 'Siircuit',
            'images_circuit_offi' => $imagesOffi
        ]);
    }

    #[Route('/siircuit/option', name: 'app_siircuit_option')]
    public function option(): Response
    {

        $listCircuit = $this->api->CallRaces(url:'all', teamId:21);

        

        // Parcourez les fichiers et affichez-les un par un
        $imagesOption = [];

        foreach($listCircuit as $circuit) {
            if ($circuit->optional == true) {
                $circuit_medals = $this->api->CallRaces(url:'run', raceId:$circuit->id, teamId:21);
                $circuit_medals = $circuit_medals->medal;
                $circuit_option = new Circuit;
                $circuit_option->setImage($circuit->image);
                $circuit_option->setName($circuit->name);
                $circuit_option->setTours($circuit->laps);
                $circuit_option->setMedals($circuit_medals);
                foreach ($circuit->sections as $section) {
                    $circuit_option->addSection($section->terrain, $section->type);
                }
                $circuit_option->getTimeAllLaps();
                $imagesOption []= $circuit_option;
            }
                
        
        }


        return $this->render('siircuit/option.html.twig', [
            'title' => 'Siircuit',
            'images_circuit_option' => $imagesOption
        ]);
    }
}
