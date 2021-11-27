<?php

namespace App\Controller;

use App\Service\ItemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemsController extends AbstractController
{
    #[Route('/items', name: 'items')]
    public function index(ItemService $itemService): Response
    {
        return $this->render('items/index.html.twig', [
            'controller_name' => 'ItemsController',
            'items' => $itemService->getProductListInStock()
        ]);
    }
}
