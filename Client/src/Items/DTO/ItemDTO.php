<?php
namespace App\Items\DTO;

final class ItemDTO
{
    protected $id;
    protected $name;
    protected $amount;

    public function __construct(int $id = null, string $name = null, float $amount = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }
}