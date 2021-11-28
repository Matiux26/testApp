<?php

namespace App\Tests\Service;

use App\Items\DTO\ItemDTO;
use PHPUnit\Framework\TestCase;
use App\Service\ItemService;

class ItemServiceTest extends TestCase
{
    public function testProductListInStockAboveZero(): void
    {
        $itemServiceStub = $this->createMock(ItemService::class);
        $itemServiceStub->method('getProductListInStock')->willReturn(
            [
                new ItemDTO(1, 'Produkt 1', 10),
                new ItemDTO(2, 'Produkt 2', 14),
            ]
        );
        $itemList = $itemServiceStub->getProductListInStock();
        foreach ($itemList as $item) {
            $this->assertTrue($item->getAmount() > 0);
        }
    }

    public function testGetProductIsTypeItemDTO(): void
    {

        $mockItemService = $this->createMock(ItemService::class);
        $mockItemService->expects($this->once())
            ->method('getItem')
            ->will($this->returnValue(new ItemDTO(1, 'Produkt 1', 10)));

        $item = $mockItemService->getItem(1);
        $this->assertInstanceOf(ItemDTO::class, $item);
    }
}
