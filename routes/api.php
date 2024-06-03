<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\CommonController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductPostController;
use App\Http\Controllers\API\ProductRequestController;
use App\Http\Controllers\API\ManagePostsController;
use App\Http\Controllers\API\FavouritesController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\UserDetailsController;


Route::group(['middleware' => 'api'], function ($router) {

    // Auth Routes
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);
    Route::get('me', [UserAuthController::class, 'user_profile']);

    // Forgot Password Routes
    Route::post('forgot-password', [UserAuthController::class, 'sendResetOTP']);
    Route::post('reset-password', [UserAuthController::class, 'resetPassword']);
});
