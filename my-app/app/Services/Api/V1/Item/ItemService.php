<?php

namespace App\Services\Api\V1\Item;

use App\DTO\Api\V1\ItemDTO;
use App\Models\Item;
use App\Repositories\Api\V1\Interfaces\ItemRepositoryInterface;
use Prewk\Result;
use Prewk\Result\Err;
use Prewk\Result\Ok;

class ItemService
{
    public function __construct(protected ItemRepositoryInterface $repo) {}

    public function create(ItemDTO $dto): Result
    {
        try {
            $this->repo->create($dto->toArray());
            $result = new Ok([
                'message' => 'Item created successfully'
            ]);
        } catch (\Exception $e) {
            $result = new Err([
                'code' => 'ITEM_CREATION_FAILED',
                'message' => $e->getMessage(),
                'status' => 500,
            ]);
        }

        return $result;
    }
}
