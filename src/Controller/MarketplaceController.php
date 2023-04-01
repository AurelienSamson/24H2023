<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketplaceController extends AbstractController
{
    #[Route('/marketplace', name: 'app_marketplace')]
    public function index(): Response
    {
        $folderBrakes = './assets/images/items/brakes';
        $filesBrakes = scandir($folderBrakes);

        $folderKits = './assets/images/items/kits';
        $filesKits = scandir($folderKits);

        $folderMotors = './assets/images/items/motors';
        $filesMotors = scandir($folderMotors);

        $folderSpoilers = './assets/images/items/spoilers';
        $filesSpoilers = scandir($folderSpoilers);

        $folderWheels = './assets/images/items/wheels';
        $filesWheels = scandir($folderWheels);

        // Parcourez les fichiers et affichez-les un par un
        $imageObjetsBrakes = [];
        $imageObjetsKits = [];
        $imageObjetsMotors = [];
        $imageObjetsSpoilers = [];
        $imageObjetsWheels = [];

        foreach($filesBrakes as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $imageObjetsBrakes []= $file;
            }
        }

        foreach($filesKits as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $imageObjetsKits []= $file;
            }
        }

        foreach($filesMotors as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $imageObjetsMotors []= $file;
            }
        }

        foreach($filesSpoilers as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $imageObjetsSpoilers []= $file;
            }
        }

        foreach($filesWheels as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $imageObjetsWheels []= $file;
            }
        }

        return $this->render('marketplace/index.html.twig', [
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
            ],
            /*$this->render('siircuit/index.html.twig', [
                'controller_name' => 'SiircuitController',
                'images_objets' => $imageObjets
            ])*/
        ]);
    }
}




$folderOffi = './assets/images/races/officielles';
        $folderOption = './assets/images/races/optionnelles';


        $filesOffi = scandir($folderOffi);
        $filesOption = scandir($folderOption);

        // Parcourez les fichiers et affichez-les un par un
        $imagesOffi = [];
        $imagesOption = [];
        foreach($filesOffi as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $imagesOffi []= $file;
            }
        }

        foreach($filesOption as $file) {
            if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                $imagesOption []= $file;
            }
        }

        return ;
