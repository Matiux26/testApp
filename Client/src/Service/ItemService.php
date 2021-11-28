<?php

namespace App\Service;

use App\Items\DTO\ItemDTO;
use App\Items\ItemsApiConsumerInterface;

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

    public function deleteItem($id): void
    {
        $this->api->deleteItem($id);
    }

    public function addItem(ItemDTO $item): void
    {
        $this->api->addItem($item);
    }

    public function getItem(int $id): ItemDTO
    {
        return $this->api->getItem($id);
    }

    public function editItem(ItemDTO $item): void
    {
        $this->api->editItem($item);
    }
}
