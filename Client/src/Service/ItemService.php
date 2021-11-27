<?php

namespace App\Service;

use App\Items\ItemsApiConsumerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ItemService
{
    public function __construct(ItemsApiConsumerInterface $api)
    {
        $this->api = $api;
    }

    public function getProductListInStock(): array
    {
        $itemList = $this->api->getItems();

        return array_filter($itemList, function ($item) {
            return $item->getAmount() > 0;
        });
    }

    public function getProductListOutOfStock(): array
    {
        $itemList = $this->api->getItems();

        return array_filter($itemList, function ($item) {
            return $item->getAmount() <= 0;
        });
    }

    public function getProductListInStockAboveFive(): array
    {
        $itemList = $this->api->getItems();

        return array_filter($itemList, function ($item) {
            return $item->getAmount() > 5;
        });
    }
}
