<?php
namespace App\Items\DTO;

final class ItemDTO
{
    private $id;
    private $name;
    private $amount;

    public function __construct(int $id, string $name, float $amount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}