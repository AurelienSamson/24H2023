<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;

class SiircuitController extends AbstractController
{
    #[Route('/siircuit', name: 'app_siircuit')]
    public function index(): Response
    {
        $folderOffi = './assets/images/races/officielles';


        $filesOffi = scandir($folderOffi);
        

        // Parcourez les fichiers et affichez-les un par un
        $imagesOffi = [];
        foreach($filesOffi as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $circuit_offi = new Circuit;
                $circuit_offi->setImage($file);
                $circuit_offi->generateNameFromImage($file);
                $imagesOffi []= $circuit_offi;
            }
        }





        return $this->render('siircuit/index.html.twig', [
            'controller_name' => 'SiircuitController',
            'images_circuit_offi' => $imagesOffi
        ]);
    }
}
