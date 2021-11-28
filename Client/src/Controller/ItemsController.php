<?php

namespace App\Controller;

use App\Form\ItemsType;
use App\Items\DTO\ItemDTO;
use App\Service\ItemService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ItemsController extends AbstractController
{
    #[Route('/items', name: 'items')]
    public function index(ItemService $itemService): Response
    {
        $request = Request::createFromGlobals();

        $itemList = [];
        $listType = $request->query->get('listType');
        try {
            if ($listType != null) {
                $itemList = $itemService->$listType();
            }
        } catch (HttpException $e) {
            $this->addFlash(
                'error',
                'Problem occured while fetching items.'
            );
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                'Wrong list parameter.'
            );
        }

        return $this->render('items/index.html.twig', [
            'controller_name' => 'ItemsController',
            'items' => $itemList
        ]);
    }

    #[Route('/items/delete', name: 'items_delete')]
    public function deleteAction(ItemService $itemService, Request $request): Response
    {
        $id = $request->query->get('id');

        try {
            $itemService->deleteItem($id);
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                'Unable to delete item.'
            );
        }

        return $this->redirectToRoute('items');
    }

    #[Route('/items/add', name: 'items_add')]
    public function addAction(ItemService $itemService, Request $request): Response
    {
        $form = $this->createForm(ItemsType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $itemService->addItem($formData);
            return $this->redirectToRoute('items');
        }

        return $this->render('items/add_item.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/items/edit', name: 'items_edit')]
    public function editAction(ItemService $itemService, Request $request): Response
    {
        $id = $request->query->get('id');
        $form = $this->createForm(ItemsType::class, $itemService->getItem($id));
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $itemService->editItem($formData);
            return $this->redirectToRoute('items');
        }

        return $this->render('items/add_item.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
