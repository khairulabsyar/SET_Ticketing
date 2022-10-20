<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UsersController;
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
// API resource better letak bawah

// Auth Login 
Route::post('user-login', [AuthController::class, 'login']);

// Auth Logout
Route::post('user-logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('user/developer', [UsersController::class, "getDev"])->middleware('auth:sanctum');
// Registration
Route::apiResource('register', UsersController::class)->only('store');

// User functionality
Route::apiResource('user', UsersController::class)->middleware('auth:sanctum')->except('store');

// User is able to access ticket functionality
Route::apiResource('ticket', TicketController::class)->middleware('auth:sanctum');

// for developer to update category
Route::apiResource('categories', CategoryController::class)->middleware('auth:sanctum');