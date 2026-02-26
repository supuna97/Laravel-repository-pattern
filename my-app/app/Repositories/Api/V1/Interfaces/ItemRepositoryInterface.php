<?php
namespace App\Repositories\Api\V1\Interfaces;

use App\Models\Item;

interface ItemRepositoryInterface
{
    public function create(array $data): Item;
}
