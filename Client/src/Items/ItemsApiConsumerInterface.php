<?php

namespace App\Items;

use App\Items\DTO\ItemDTO;

interface ItemsApiConsumerInterface
{
    public function getItem(int $itemId) : ItemDTO;
    public function getItems() : array;
    public function deleteItem(int $itemId) : void;
    public function addItem(ItemDTO $itemDTO) : void;
}
