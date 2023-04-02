<?php

namespace App\Controller;

use App\Service\ApiRestService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function index(Request $request): Response
    {
        if (count($request->request) > 0) {
            $this->buy($request);
        }

        $statEquip = $this->getStat();

        return $this->render('marketplace/index.html.twig', [
            'category' => null,
            'items' => $this->getItems(),
            'statEqui' => $statEquip,
            'itemsCategory' => $this->itemsCategory,
        ]);
    }

    #[Route('/marketplace/type/{type}', name: 'app_marketplace_items')]
    public function items(Request $request, $type)
    {
        if (count($request->request) > 0) {
            $this->buy($request);
        }

        $statEquip = $this->getStat();

        return $this->render('marketplace/items.html.twig', [
            'category' => $type,
            'items' => $this->getItems($type),
            'statEqui' => $statEquip,
            'itemsCategory' => $this->itemsCategory,
        ]);
    }

    public function getStat()
    {
        $itemVehicul = $this->api->CallTeams(teamId:21, url:'inventory/equip')->items;

        $items = [];
        foreach ($itemVehicul as $key => $value) {
            foreach ($value->item->statistiques as $key => $stat) {
                switch ($stat->type) {
                    case 'Power':
                            $items [$value->item->type][$stat->type]= [true, $stat->value];
                        break;
                        case 'Grip':
                            $items [$value->item->type][$stat->type]= [true, $stat->value];
                        break;
                    case 'Weight':
                            $items [$value->item->type][$stat->type]= [false, $stat->value];
                        break;
                    case 'Energy consumption':
                            $items [$value->item->type][$stat->type]= [false, $stat->value];
                        break;
                    case 'Acceleration':
                            $items [$value->item->type][$stat->type]= [true, $stat->value];
                        break;
                    case 'Handling ability':
                            $items [$value->item->type][$stat->type]= [true, $stat->value];
                        break;
                    case 'Wear':
                            $items [$value->item->type][$stat->type]= [false, $stat->value];
                        break;
                }
            }
        }

        return $items;
    }

    public function buy($request)
    {
        foreach ($request->request as $key => $value){
            if ($key == "itemId") $itemId = $value;
            if ($key == "teamId") $teamId = $value;
        }

        $this->api->CallItems(methode:'POST', url:'buy', itemId:$itemId, teamId:$teamId);
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
}