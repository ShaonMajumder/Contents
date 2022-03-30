<?php

use App\Http\Controllers\Api\V1\AdminUserController;
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

    Route::middleware(['middleware' => 'AdminApiMiddleware'])->prefix('admin')->group(function(){
        Route::prefix('get')->group(function(){
            Route::get('/users', [AdminUserController::class, "listUsers"]);
        });
    });
});
