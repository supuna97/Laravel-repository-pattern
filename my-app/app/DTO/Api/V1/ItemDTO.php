<?php

namespace App\DTO\Api\V1;

class ItemDTO
{
    private string $name;
    private ?string $description;
    private float $price;
    private bool $isActive;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->description = $data['description'] ?? null;
        $this->price = (float) $data['price'];
        $this->isActive = $data['is_active'] ?? true; // default true
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setActive(bool $active): self
    {
        $this->isActive = $active;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_active' => $this->isActive,
        ];
    }
}