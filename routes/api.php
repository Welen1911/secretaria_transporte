<?php

use App\Http\Controllers\AutoMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/automobile')->group(function () {
    Route::get('/', [AutoMobileController::class, 'index'])->name('automobile.index');

    Route::get('/{id}', [AutoMobileController::class, 'show'])->name('automobile.show');

    Route::post('/', [AutoMobileController::class, 'store'])->name('automobile.store');

    Route::put('/{id}', [AutoMobileController::class, 'update'])->name('automobile.update');

    Route::delete('/{id}', [AutoMobileController::class, 'destroy'])->name('automobile.destroy');
});
