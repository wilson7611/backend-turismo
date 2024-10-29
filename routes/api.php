<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::apiResource('routes', RouteController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('places', PlaceController::class);

Route::middleware('auth:sanctum')->group(function () {
    
    
});