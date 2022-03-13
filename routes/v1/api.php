<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Api\V1\DriverController;
use App\Http\Controllers\Api\V1\StatusController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, "login"]);
Route::middleware(["auth:sanctum"])->group(function () {    
    /**
     * Logout Authenticated User
     */
    Route::any('/logout', [LoginController::class, "logout"]);

    Route::get('/get/status/all', [StatusController::class, "getAllStatus"]);
    Route::get('/get/status/pickup', [StatusController::class, "getPickupStatuses"]);
    Route::get('/get/status/delivery', [StatusController::class, "getDeliveryStatuses"]);
    
    /**
     * Driver Profile / Details
     */
    Route::prefix('driver')->group(function(){
        Route::get('/profile', [DriverController::class, "getProfile"]);
        
        Route::prefix('parcels')->group(function(){
            Route::get('/list/{status}', [DriverController::class, "listParcel"]);
            Route::get('/summary', [DriverController::class, "getParcelsSummary"]);
            Route::post('/change-status', [DriverController::class, "changeParcelStatus"]);    
        });
    });
    

});
