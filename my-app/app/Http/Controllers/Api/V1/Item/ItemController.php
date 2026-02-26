<?php

namespace App\Http\Controllers\Api\V1\Item;

use App\DTO\Api\V1\ItemDTO;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\ItemRequest;
use App\Http\Requests\Api\V1\ItemStoreRequest;
use App\Http\Requests\Api\V1\ItemUpdateRequest;
use App\Services\Api\V1\Item\ItemService;
use App\Transformers\Api\V1\Item\GetItemListTransformer;
use Illuminate\Http\JsonResponse;

class ItemController extends ApiController
{
    public function __construct(protected ItemService $service) {}

    public function store(ItemStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $itemDTO = ItemDTO::fromArray($validatedData);
        $result = $this->service->create($itemDTO);

        if ($result->isErr()) {
            $err = $result->unwrapErr();
            return static::errorResponse($err['code'], $err['message'], $err['status']);
        } else {
            $data = $result->unwrap();
            $response = static::successResponse($data['message'], 200);
        }

        return $response;
    }

    public function getItemList(): JsonResponse
    {
        $result = $this->service->getItemList();

        if ($result->isErr()) {
            $err = $result->unwrapErr();
            $response = static::errorResponse($err['code'], $err['message'], $err['status']);
        } else {
            $items = $result->unwrap();
            $response = fractal($items, new GetItemListTransformer)->respond(200);
        }

        return $response;
    }

    public function getItemById(ItemRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $result = $this->service->getItemById($validatedData['id']);

        if ($result->isErr()) {
            $err = $result->unwrapErr();
            $response = static::errorResponse($err['code'], $err['message'], $err['status']);
        } else {
            $item = $result->unwrap();
            $response = fractal($item, new GetItemListTransformer)->respond(200);
        }

        return $response;
    }

    public function update(int $id, ItemUpdateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $itemDTO = ItemDTO::fromArray($validatedData);
        $result = $this->service->updateItem($id, $itemDTO);

        if ($result->isErr()) {
            $err = $result->unwrapErr();
            return static::errorResponse($err['code'], $err['message'], $err['status']);
        } else {
            $data = $result->unwrap();
            $response = static::successResponse($data['message'], 200);
        }

        return $response;
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->deleteItem($id);

        if ($result->isErr()) {
            $err = $result->unwrapErr();
            $response = static::errorResponse($err['code'], $err['message'], $err['status']);
        } else {
            $data = $result->unwrap();
            $response = static::successResponse($data['message'], 200);
        }

        return $response;
    }
}
