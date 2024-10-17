<?php

use App\Http\Controllers\TowerOfHanoiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/state', [TowerOfHanoiController::class, 'getState']);
Route::post('/move/{from}/{to}', [TowerOfHanoiController::class, 'move']);
