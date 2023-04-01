<?php

namespace App\Controller;

use App\Service\ApiRestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketplaceController extends AbstractController
{
    public $itemsCategory;
    public function __construct(public ApiRestService $api) {
        $this->itemsCategory = [
            'brakes'   => 'Freins',
            'kits'     => 'Carrosserie',
            'motors'   => 'Moteur',
            'spoilers' => 'Aileron',
            'wheels'   => 'Roues',
        ];
        $this->api = $api;
    }

    #[Route('/marketplace', name: 'app_marketplace')]
    public function index(): Response
    {
        return $this->render('marketplace/index.html.twig', [
            'category' => null,
            'stats' => $this->getStats(),
            'itemsCategory' => $this->itemsCategory,
            'imageObjets' => $this->getImageObjets()
        ]);
    }

    #[Route('/marketplace/{key}', name: 'app_marketplace_items')]
    public function items($key)
    {
        $CallItems = $this->api->CallItems('GET');

        return $this->render('marketplace/items.html.twig', [
            'category' => $key,
            'CallItems' => $CallItems,
            'itemsCategory' => $this->itemsCategory,
        ]);
    }

    public function getStats()
    {
        return [
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
        ];
    }

    public function getImageObjets($objets = "")
    {
        $imageObjets = [
            'imageObjets_brakes'   => [],
            'imageObjets_kits'     => [],
            'imageObjets_motors'   => [],
            'imageObjets_spoilers' => [],
            'imageObjets_wheels'   => [],
        ];

        foreach ($this->itemsCategory as $key => $caterogy) {
            $filesBrakes = scandir('./assets/images/items/' . $key);
            foreach($filesBrakes as $file) {
                if($file != "." && $file != "..") { // Ignorez les fichiers "." et ".." qui représentent le dossier courant et le dossier parent
                    $imageObjets['imageObjets_'.$key] []= $file;
                }
            }
        }

        return ($objets)? $imageObjets[$objets] : $imageObjets;
    }
}