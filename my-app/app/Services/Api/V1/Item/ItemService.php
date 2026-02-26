<?php

namespace App\Services\Api\V1\Item;

use App\DTO\Api\V1\ItemDTO;
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

    public function getItemList(): Result
    {
        try {
            $items = $this->repo->getAll();
            $result = new Ok($items);
        } catch (\Exception $e) {
            $result = new Err([
                'code' => 'ITEM_LIST_RETRIEVAL_FAILED',
                'message' => $e->getMessage(),
                'status' => 500,
            ]);
        }

        return $result;
    }

    public function getItemById(int $id): Result
    {
        try {
            $item = $this->repo->getById($id);
            if ($item) {
                $result = new Ok($item);
            } else {
                $result = new Err([
                    'code' => 'ITEM_NOT_FOUND',
                    'message' => 'Item not found',
                    'status' => 404,
                ]);
            }
        } catch (\Exception $e) {
            $result = new Err([
                'code' => 'ITEM_RETRIEVAL_FAILED',
                'message' => $e->getMessage(),
                'status' => 500,
            ]);
        }

        return $result;
    }

    public function updateItem(int $id, ItemDTO $dto): Result
    {
        try {
            $updatedItem = $this->repo->updateItem($id, $dto->toArray());

            if ($updatedItem) {
                $result = new Ok([
                    'message' => 'Item updated successfully'
                ]);
            } else {
                $result = new Err([
                    'code' => 'ITEM_NOT_FOUND',
                    'message' => 'Item not found',
                    'status' => 404,
                ]);
            }
        } catch (\Exception $e) {
            $result = new Err([
                'code' => 'ITEM_UPDATE_FAILED',
                'message' => $e->getMessage(),
                'status' => 500,
            ]);
        }

        return $result;
    }

    public function deleteItem(int $id): Result
    {
        try {
            $deleted = $this->repo->deleteItem($id);

            if ($deleted) {
                $result = new Ok([
                    'message' => 'Item deleted successfully'
                ]);
            } else {
                $result = new Err([
                    'code' => 'ITEM_NOT_FOUND',
                    'message' => 'Item not found',
                    'status' => 404,
                ]);
            }
        } catch (\Exception $e) {
            $result = new Err([
                'code' => 'ITEM_DELETION_FAILED',
                'message' => $e->getMessage(),
                'status' => 500,
            ]);
        }

        return $result;
    }
}
