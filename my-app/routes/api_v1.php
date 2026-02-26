<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Item\ItemController;

Route::post('items/create', [ItemController::class, 'store']);
Route::get('items/list', [ItemController::class, 'getItemList']);
Route::get('items/{id}', [ItemController::class, 'getItemById']);
Route::patch('items/update/{id}', [ItemController::class, 'update']);
Route::delete('items/delete/{id}', [ItemController::class, 'destroy']);
