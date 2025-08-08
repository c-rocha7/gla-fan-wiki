<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::prefix('characters')->group(function () {
    Route::get('/', [CharacterController::class, 'index']);
    Route::post('/', [CharacterController::class, 'store']);
    Route::get('/{id}', [CharacterController::class, 'show']);
    Route::put('/{id}', [CharacterController::class, 'update']);
    Route::delete('/{id}', [CharacterController::class, 'destroy']);
});
