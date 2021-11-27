<?php

namespace App\Items;

interface ItemsApiConsumerInterface
{
    public function getItem();
    public function getItems();
    public function deleteItem();
    public function addItem();
}
