<?php

namespace App\Controller;

use App\Service\ApiRestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketplaceController extends AbstractController
{
    // public function __construct(public ApiRestService $api) {
    //     $this->api = $api;
    // }

    #[Route('/marketplace', name: 'app_marketplace')]
    public function index(): Response
    {
        // $items = $this->api->CallItems(methode:'GET');


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
            // 'items' => $items,
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
            'controller_name' => 'SiircuitController',
            'images_objets_brakers' => $imageObjetsBrakes,
            'images_objets_kits' => $imageObjetsKits,
            'images_objets_motors' => $imageObjetsMotors,
            'images_objets_wheels' => $imageObjetsWheels,
            'images_objets_wheels' => $imageObjetsSpoilers
        ]);
    }
}