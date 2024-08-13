<?php

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
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tickets', \App\Http\Controllers\TicketController::class);
});

Route::post('register',[\App\Http\Controllers\API\UserAuthController::class,'register'])->name('register');;
Route::post('login',[\App\Http\Controllers\API\UserAuthController::class,'login'])->name('login');;
Route::post('logout',[\App\Http\Controllers\API\UserAuthController::class,'logout'])->middleware('auth:sanctum');
