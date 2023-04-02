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

    #[Route('/marketplace/all', name: 'app_marketplace')]
    public function index(): Response
    {
        return $this->render('marketplace/index.html.twig', [
            'category' => null,
            'items' => $this->getItems(),
            'stats' => $this->getStats(),
            
            'itemsCategory' => $this->itemsCategory,
            'imageObjets' => $this->getImageObjets()
        ]);
    }

    #[Route('/marketplace/type/{type}', name: 'app_marketplace_items')]
    public function items($type)
    {
        return $this->render('marketplace/items.html.twig', [
            'category' => $type,
            'items' => $this->getItems($type),
            'stats' => $this->getStats(),

            'itemsCategory' => $this->itemsCategory,
        ]);
    }

    #[Route('/marketplace/inventory', name: 'app_marketplace_inventory')]
    public function inventory()
    {
        
        return $this->render('marketplace/inventory.html.twig', [
            'stats' => $this->getStats(),
            // 'category' => $type,
            // 'items' => $this->getItems($type),

            // 'itemsCategory' => $this->itemsCategory,
        ]);
    }

    public function getItems($type = "")
    {
        $categories = [
            'brakes' => 'Brakes',
            'kits' => 'Bodywork',
            'motors' => 'Motor',
            'spoilers' => 'Spoiler',
            'wheels' => 'Wheels'
        ];

        $CallItems = $this->api->CallItems('GET');
        $items = [];

        if ($type) {
            foreach ($CallItems as $value) {
                if ($value->type == $categories[$type]) {
                    $items []= $value;
                }
            }
        }else{
            $items = $CallItems;
        }

        return $items;
    }

    public function getStats()
    {
        return [
            "label" => [
                "puissance",
                "accélération",
                "adhérence",
                "maniabilité",
                "consommation",
                "usure",
                "poids",
            ],
            "statsVoiture"=> [
                2,
                0,
                0,
                0,
                0,
                0,
                0,
            ],
            "statsVoitureModifie"=> [
                1,
                0,
                0,
                0,
                0,
                0,
                0,
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