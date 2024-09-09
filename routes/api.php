<?php

use App\Http\Controllers\API\{
    AutoMobileController,
    CompanyController,
    DriverController,
    TravelController,
    TurnController,
    UserController
};
use App\Http\Middleware\ApiAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::middleware(ApiAuth::class)->group(function () {
    Route::get('/me', [UserController::class, 'me'])->name('user.me');
    Route::apiResource('/users', UserController::class)->only(['create', 'edit', 'update', 'destroy']);
    Route::apiResource('/automobile', AutoMobileController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::apiResource('/turn', TurnController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::apiResource('/company', CompanyController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::apiResource('/driver', DriverController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::apiResource('/travel', TravelController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::prefix('/users')->group(function () {
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::get('/', [UserController::class, 'index'])->name("user.index");
    Route::get('/{id}', [UserController::class, 'show'])->name("user.show");
    Route::get('/matricula/{matricula}', [UserController::class, 'getByMatricula'])->name('user.matricula');
});
Route::prefix('/automobile')->group(function () {
    Route::get('/', [AutoMobileController::class, 'index'])->name('automobile.index');
    Route::get('/{id}', [AutoMobileController::class, 'index'])->name('automobile.show');
    Route::get('/{turnId}/{capacity}', [AutoMobileController::class, 'getByTurnAndCapacitiy'])->name('automobile.turn.capacity');
});
Route::prefix('/turn')->group(function () {
    Route::get('/', [TurnController::class, 'index'])->name('turn.index');
    Route::get('/{id}', [TurnController::class, 'show'])->name('turn.show');
});
Route::prefix('/company')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/{id}', [CompanyController::class, 'show'])->name('company.show');
});
Route::prefix('/automobile')->group(function () {
    Route::get('/', [AutoMobileController::class, 'index'])->name('automobile.index');
    Route::get('/{id}', [AutoMobileController::class, 'show'])->name('automobile.show');
    Route::get('/{turnId}/{capacity}', [AutoMobileController::class, 'getByTurnAndCapacitiy'])->name('automobile.turn.capacity');
});
Route::prefix('/driver')->group(function () {
    Route::get('/', [DriverController::class, 'index'])->name('driver.index');
    Route::get('/{id}', [DriverController::class, 'show'])->name('driver.show');
    Route::get('/{turnId}/{capacity}', [DriverController::class, 'getByTurnAndCategoryCNH'])->name('driver.turn.capacity');
});
Route::prefix('/travel')->group(function () {
    Route::get('/', [TravelController::class, 'index'])->name('travel.index');
    Route::get('/{id}', [TravelController::class, 'show'])->name('travel.show');
    Route::get('/automobile/{id}', [TravelController::class, 'showByAutomobileId']);
    Route::get('/driver/{id}', [TravelController::class, 'showByDriverId']);
});
