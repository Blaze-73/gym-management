<?php

use App\Http\Controllers\MembershipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;

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

// Example test route
Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});

// Plan resource routes (GET, POST, PUT, DELETE)
Route::apiResource('plans', PlanController::class);
Route::apiResource('membership',MembershipController::class);