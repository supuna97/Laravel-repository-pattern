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
}
