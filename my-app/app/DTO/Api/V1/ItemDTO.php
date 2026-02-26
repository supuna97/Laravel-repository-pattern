<?php

namespace App\DTO\Api\V1;

class ItemDTO extends SuperDTO
{
    private ?string $name;
    private ?string $description;
    private ?float $price;
    private ?bool $isActive;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->price = ($data['price'] ?? null);
        $this->isActive = $data['is_active'] ?? true;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(?bool $active): self
    {
        $this->isActive = $active;
        return $this;
    }

    /**
     * Convert DTO to array for repository
     * Removes null values so update only affects given fields
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_available' => $this->isActive,
        ], fn($v) => !is_null($v));
    }

    /**
     * Static helper to create DTO from validated data
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}
