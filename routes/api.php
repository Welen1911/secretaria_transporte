<?php

use App\Http\Controllers\AutoMobileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TurnController;
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

Route::prefix('/turn')->group(function () {
    Route::get('/', [TurnController::class, 'index'])->name('turn.index');

    Route::get('/{id}', [TurnController::class, 'show'])->name('turn.show');

    Route::post('/', [TurnController::class, 'store'])->name('turn.store');

    Route::put('/{id}', [TurnController::class, 'update'])->name('turn.update');

    Route::delete('/{id}', [TurnController::class, 'destroy'])->name('turn.destroy');
});

Route::prefix('/company')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('company.index');

    Route::get('/{id}', [CompanyController::class, 'show'])->name('company.show');

    Route::post('/', [CompanyController::class, 'store'])->name('company.store');

    Route::put('/{id}', [CompanyController::class, 'update'])->name('company.update');

    Route::delete('/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
});

