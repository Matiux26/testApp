<?php

namespace App\Controller;

use App\Service\ItemService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class ItemsController extends AbstractController
{
    #[Route('/items', name: 'items')]
    public function index(ItemService $itemService): Response
    {
        $itemList = [];

        try{
            $itemList = $itemService->getProductListInStock();
        }catch(HttpException $e) {
            $this->addFlash(
                'error',
                'Problem occured while fetching items.'
            );
        }

        return $this->render('items/index.html.twig', [
            'controller_name' => 'ItemsController',
            'items' => $itemList
        ]);
    }
}
