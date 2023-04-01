<?php

namespace App\Controller;

use App\Service\ApiRestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemsInventaireController extends AbstractController
{
    public function __construct(public ApiRestService $api) {
        $this->api = $api;
    }

    #[Route('/items/inventaire', name: 'app_items_inventaire')]
    public function index($itemId): Response
    {

        $items = $this->api->CallItems(methode:'GET', params:[
            'type' => 'Motor'
        ]);

        dd($items);

        return $this->render('items_inventaire/index.html.twig', [
            'controller_name' => 'ItemsInventaireController',
        ]);
    }
}
