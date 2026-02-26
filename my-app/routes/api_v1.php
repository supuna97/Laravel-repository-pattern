<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Item\ItemController;


Route::post('item/create', [ItemController::class, 'store']);
