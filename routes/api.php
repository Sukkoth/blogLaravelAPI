<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/user', [AuthController::class, 'details'])->middleware('auth:api');
});

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::middleware('auth:api')->group(function () {
        Route::post('/', [BlogController::class, 'store']);
        Route::patch('/{blog}', [BlogController::class, 'update']);
        Route::delete('/{blog}', [BlogController::class, 'delete']);
    });

});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
});

/**
 * BLOG CONTROLLER 
 * THE MAIN FUNCTIONS
 * POPULAR 
 * RECENT 
 * AUTHOR CONTROLLER 
 */