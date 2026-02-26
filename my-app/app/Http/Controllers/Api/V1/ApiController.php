<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Transformers\Api\V1\ErrorTransformer;
use App\Transformers\Api\V1\GenericSuccessTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Serializer\ArraySerializer;

class ApiController extends Controller
{
    protected static function successResponse(string $message, int $status = 200): JsonResponse
    {
        return fractal($message, new GenericSuccessTransformer, new ArraySerializer)->respond($status);
    }

    protected static function errorResponse(string $code, string $message, int $status = 500): JsonResponse
    {
        $err = [
            'code' => $code,
            'message' => $message,
        ];

        return fractal((object) $err, new ErrorTransformer, new ArraySerializer)->respond($status);
    }
}
