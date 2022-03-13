<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\ApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, "login"]);


Route::middleware(["auth:sanctum"])->group(function () {    
    /**
     * Logout Authenticated User
     */
    Route::any('/logout', [LoginController::class, "logout"]);
    
    Route::post('/visited', [ApiController::class, "visited"]);
    
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
