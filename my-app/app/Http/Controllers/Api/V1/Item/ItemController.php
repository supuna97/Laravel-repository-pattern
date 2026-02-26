<?php

namespace App\Http\Controllers\Api\V1\Item;

use App\DTO\Api\V1\ItemDTO;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\ItemStoreRequest;
use App\Services\Api\V1\Item\ItemService;
use Illuminate\Http\JsonResponse;

class ItemController extends ApiController
{
    public function __construct(protected ItemService $service) {}

    public function store(ItemStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $itemDTO = new ItemDTO($validatedData);
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
}
