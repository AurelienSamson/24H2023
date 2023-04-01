<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;

class SiircuitOptionController extends AbstractController
{

    
    #[Route('/siircuit/option', name: 'app_siircuit_option')]
    public function index(): Response
    {

        $folderOption = './assets/images/races/optionnelles';


        $filesOption = scandir($folderOption);

        // Parcourez les fichiers et affichez-les un par un
        $imagesOption = [];

        foreach($filesOption as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $circuit_option = new Circuit;
                $circuit_option->setImage($file);
                $circuit_option->generateNameFromImage($file);
                $imagesOption []= $circuit_option;
            }
        }


        return $this->render('siircuit_option/index.html.twig', [
            'controller_name' => 'SiircuitOptionController',
            'images_circuit_option' => $imagesOption
        ]);
    }
}
