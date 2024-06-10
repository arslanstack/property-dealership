<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\FeaturesController;
use App\Http\Controllers\API\NeighborhoodsController;
use App\Http\Controllers\API\PropertiesController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\TypesController;

Route::group(['middleware' => 'api'], function ($router) {

    // Auth Routes
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);
    Route::get('me', [UserAuthController::class, 'user_profile']);

    Route::group(['prefix' => 'features'], function () {
        Route::get('all', [FeaturesController::class, 'index']);
    });
    Route::group(['prefix' => 'neighborhoods'], function () {
        Route::get('all', [NeighborhoodsController::class, 'index']);
    });
    Route::group(['prefix' => 'types'], function () {
        Route::get('all', [TypesController::class, 'index']);
    });
    Route::group(['prefix' => 'properties'], function () {
        Route::get('all', [PropertiesController::class, 'index']);
        Route::get('featured', [PropertiesController::class, 'featured']);
        Route::get('recent', [PropertiesController::class, 'recent']);
        Route::get('filters', [PropertiesController::class, 'filters']);
        Route::post('all-filtered', [PropertiesController::class, 'all']);
    });
    Route::group(['prefix' => 'search'], function () {
        Route::post('search', [SearchController::class, 'index']);
    });
});
