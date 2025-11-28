<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AccessTokensController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products',ProductController::class);

// Access Tokens
Route::post('access-tokens', [AccessTokensController::class, 'store'])->middleware('guest:sanctum');

// Delete Access Token
Route::delete('access-tokens/{token?}', [AccessTokensController::class, 'destroy'])->middleware('auth:sanctum');



