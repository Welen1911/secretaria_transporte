<?php

use App\Http\Controllers\API\{
    AutoMobileController,
    CompanyController,
    DriverController,
    TravelController,
    TurnController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/automobile', AutoMobileController::class);
Route::prefix('/automobile')->group(function () {
    Route::get('/{turnId}/{capacity}', [AutoMobileController::class, 'getByTurnAndCapacitiy'])->name('automobile.turn.capacity');
});
Route::apiResource('/turn', TurnController::class);
Route::apiResource('/company', CompanyController::class);
Route::apiResource('/driver', DriverController::class);
Route::prefix('/driver')->group(function () {
    Route::get('/{turnId}/{capacity}', [DriverController::class, 'getByTurnAndCategoryCNH'])->name('driver.turn.capacity');
});
Route::apiResource('/travel', TravelController::class);
Route::prefix('/travel')->group(function () {
    Route::get('/automobile/{id}', [TravelController::class, 'showByAutomobileId']);
    Route::get('/driver/{id}', [TravelController::class, 'showByDriverId']);
});
