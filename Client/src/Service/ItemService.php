<?php

namespace App\Service;

use App\Items\ItemsApiConsumerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ItemService extends AbstractController
{
    private array $itemList;

    public function __construct(ItemsApiConsumerInterface $api)
    {
        $api->setApiUrl($this->getParameter('app.apiUrl'));
        $this->itemList = $api->getItems();
    }

    public function getProductListInStock(): array
    {
        return array_filter($this->itemList, function ($item) {
            if ($item->amount > 0) {
                return false;
            }
            return true;
        });
    }

    public function getProductListOutOfStock(): array
    {
        return array_filter($this->itemList, function ($item) {
            if ($item->amount <= 0) {
                return false;
            }
            return true;
        });
    }

    public function getProductListInStockAboveFive(): array
    {
        return array_filter($this->itemList, function ($item) {
            if ($item->amount > 5) {
                return false;
            }
            return true;
        });
    }
}
