<?php
namespace App\Items\Mapper;

use App\Items\DTO\ItemDTO;

final class ItemMapper
{
    public static function map(array $data): ItemDTO
    {
        return new ItemDTO(
            $data['id'],
            $data['name'],
            $data['amount']
        );
    }
}