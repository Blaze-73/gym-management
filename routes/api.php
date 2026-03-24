<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MembershipController;
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
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('me',[AuthController::class,'me']); 
    // kolchi ki9dr ychof
    Route::get('/plans',[PlanController::class,'index']);
    Route::get('/plans/{plan}',[PlanController::class,'show']);
    // auth users kichofo
    Route::get('/memeberships',[MembershipController::class,'index']);
    Route::get('/memeberships/{membership}',[MembershipController::class,'show']);

    // auth admin chno kidiro
    Route::middleware('role:admin')->group(function(){
        Route::post('/plans',[PlanController::class,'store']);
        Route::put('/plans/{plan}',[PlanController::class,'update']);
        Route::delete('/plans/{plan}',[PlanController::class,'destroy']);
    //Membership managementt
        Route::post('/memberships',[MembershipController::class,'store']);
        Route::put('/memberships/{membership}',[MembershipController::class,'update']);
        Route::delete('/memberships/{membership}',[MembershipController::class,'destroy']);
        
    });
});


// Example test route
Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});

// Plan resource routes (GET, POST, PUT, DELETE)




