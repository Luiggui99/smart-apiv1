<?php

use App\Http\Controllers\Api\CategoryContorller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('category', [CategoryContorller::class, 'index']);
Route::post('category', [CategoryContorller::class, 'store']);
Route::get('category/{id}', [CategoryContorller::class, 'show']);
Route::get('category/{id}/edit', [CategoryContorller::class, 'edit']);
Route::put('category/{id}/edit', [CategoryContorller::class, 'update']);
Route::delete('category/{id}/delete', [CategoryContorller::class, 'destroy']);