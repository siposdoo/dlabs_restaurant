<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/menu-items', [Controllers\ItemController::class, 'index']);
Route::post('/orders', [Controllers\OrderController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/checkrole', [AuthController::class, 'checkRole']);
});

Route::middleware(['auth:sanctum', 'role:manager'])->group(function () {
 
    Route::get('/items', [Controllers\ItemController::class, 'index']);
    Route::post('/items', [Controllers\ItemController::class, 'store']);
    Route::put('/items/{id}', [Controllers\ItemController::class, 'update']);

    Route::get('/tables', [Controllers\TableController::class, 'index']);
    Route::post('/tables', [Controllers\TableController::class, 'store']);
    Route::put('/tables/{id}', [Controllers\TableController::class, 'update']);
});
