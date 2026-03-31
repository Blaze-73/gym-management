<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MembershipController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;



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

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show']);
    Route::put('/', [ProfileController::class, 'update']);
    Route::put('/password', [ProfileController::class, 'updatePassword']);
    Route::delete('/', [ProfileController::class, 'destroy']); });

    // kolchi ki9dr ychof
    Route::get('/plans',[PlanController::class,'index']);
    Route::get('/plans/{plan}',[PlanController::class,'show']);
    // auth users kichofo
    Route::get('/memeberships',[MembershipController::class,'index']);
    Route::get('/memeberships/{membership}',[MembershipController::class,'show']);

    // auth attendance kichof
    Route::prefix('attendance')->group(function(){
    Route::post('/check-in',[AttendanceController::class, 'checkIn']);
    Route::post('/check-out',[AttendanceController::class, 'checkOut']);
    Route::get('/history',[AttendanceController::class, 'history']);
    });

    // auth admin chno kidiro
    Route::middleware('role:admin')->group(function(){
        Route::post('/plans',[PlanController::class,'store']);
        Route::put('/plans/{plan}',[PlanController::class,'update']);
        Route::delete('/plans/{plan}',[PlanController::class,'destroy']);
    //Membership managementt
        Route::post('/memberships',[MembershipController::class,'store']);
        Route::put('/memberships/{membership}',[MembershipController::class,'update']);
        Route::delete('/memberships/{membership}',[MembershipController::class,'destroy']);
    //dashboard admin
        Route::get('/dashboard',[DashboardController::class,'index']);
        Route::get('/dashboard/trends',[DashboardController::class,'trends']);
    // attendance management
        Route::get('/attendance',[AttendanceController::class,'index']);
        Route::get('/attendance/active',[AttendanceController::class,'active']);
    // product mn 3and admin
        Route::post('/products',[ProductController::class,'store']);
        Route::put('/products/{product}',[ProductController::class,'update']);
        Route::delete('/products/{product}',[ProductController::class,'destroy']);
        Route::put('/products/{product}/stock',[ProductController::class,'updateStock']);
    // categories dyal admin
        Route::post('/categories',[CategoryController::class,'store']);
        Route::put('/categories/{category}',[CategoryController::class,'update']);
        Route::delete('/categories/{category}',[CategoryController::class,'delete']);
    // chno order lli kimanagi
        Route::put('orders/{order}/status',[OrderController::class,'updateStatus']);
        Route::get('orders/statistics',[OrderController::class,'statistics']);
    });
});


// Example test route
Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});

// Plan resource routes (GET, POST, PUT, DELETE)




