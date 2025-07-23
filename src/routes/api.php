<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyApiController;
use App\Http\Controllers\Api\BuyerApiController;

Route::apiResource('buyers', BuyerApiController::class);
Route::apiResource('properties', PropertyApiController::class);
