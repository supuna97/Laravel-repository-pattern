<?php

namespace App\Repositories\Api\V1\Interfaces;

use App\Models\Item;

interface ItemRepositoryInterface
{
    public function create(array $data): Item;

    public function getAll(): array;

    public function getById(int $id): ?Item;

    public function updateItem(int $id, array $data): ?Item;

    public function deleteItem(int $id): bool;
}
