<?php

namespace App\Repositories\Api\V1\Implementations;

use App\Models\Item;
use App\Repositories\Api\V1\Interfaces\ItemRepositoryInterface;

class ItemRepository implements ItemRepositoryInterface
{

    public function create(array $data): Item
    {
        return Item::create($data);
    }

    public function getAll(): array
    {
        return Item::all()->toArray();
    }

    public function getById(int $id): ?Item
    {
        return Item::find($id);
    }

    public function updateItem(int $id, array $data): ?Item
    {
        $item = Item::find($id);

        if ($item) {
            $item->update($data);
            return $item;
        }

        return null;
    }

    public function deleteItem(int $id): bool
    {
        $item = Item::find($id);

        if ($item) {
            return $item->delete();
        }

        return false;
    }
}
