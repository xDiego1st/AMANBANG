<?php

use App\Http\Controllers\API\LUNA\AuthController;
use App\Http\Controllers\API\LUNA\UserBLController;
use App\Http\Middleware\CleanExpiredTokens;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'luna'], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('/check-token/{token}', [UserBLController::class, 'checkTokenLogin']);
    Route::post('/check-hwid', [AuthController::class, 'checkHwidLogin']);

    Route::middleware([CleanExpiredTokens::class])->group(function () {
        Route::get('/active-users', [UserBLController::class, 'getActiveUsers']);
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        Route::post('/change-password', [UserBLController::class, 'changePassword']);
    });

    Route::middleware(['auth:sanctum', 'ensure.is.admin'])->group(function () {
        //------------------------------------
        Route::get('/list/user', [UserBLController::class, 'index']);
        Route::post('/create/user', [UserBLController::class, 'store']);
        Route::get('/detail/user/{id}', [UserBLController::class, 'show']);
        Route::post('/update/user/{id}', [UserBLController::class, 'update']);
        Route::delete('/delete/user/{id}', [UserBLController::class, 'destroy']);
        //-------------------------------------

        Route::post('/user/reset-password/{id}', [UserBLController::class, 'resetPassword']);
        Route::post('/user/update-active-until/{id}', [UserBLController::class, 'updateActiveUntil']);
        Route::post('/user/reset-hwid/{id}', [UserBLController::class, 'resetHWID']);
    });
});
