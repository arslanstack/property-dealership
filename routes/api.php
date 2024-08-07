<?php

use App\Http\Controllers\API\AgentController;
use App\Http\Controllers\API\CitiesController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\EvaluationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\FeaturesController;
use App\Http\Controllers\API\NeighborhoodsController;
use App\Http\Controllers\API\PropertiesController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\TestimonialController;
use App\Http\Controllers\API\TypesController;

Route::group(['middleware' => 'api'], function ($router) {

    // Auth Routes
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);
    Route::get('me', [UserAuthController::class, 'user_profile']);

    Route::group(['prefix' => 'features'], function () {
        Route::get('all', [FeaturesController::class, 'index']);
        Route::get('details/{id}', [FeaturesController::class, 'show']);
    });
    Route::group(['prefix' => 'neighborhoods'], function () {
        Route::get('all', [NeighborhoodsController::class, 'index']);
        Route::get('details/{id}', [NeighborhoodsController::class, 'show']);
    });
    Route::group(['prefix' => 'types'], function () {
        Route::get('all', [TypesController::class, 'index']);
        Route::get('details/{id}', [TypesController::class, 'show']);
    });
    Route::group(['prefix' => 'testimonials'], function () {
        Route::get('all', [TestimonialController::class, 'index']);
        Route::get('details/{id}', [TestimonialController::class, 'show']);
    });
    Route::group(['prefix' => 'cities'], function () {
        Route::get('all', [CitiesController::class, 'index']);
        Route::get('details/{id}', [CitiesController::class, 'show']);
    });
    Route::group(['prefix' => 'agents'], function () {
        Route::get('all', [AgentController::class, 'index']);
        Route::get('details/{id}', [AgentController::class, 'show']);
    });
    Route::group(['prefix' => 'properties'], function () {
        Route::get('featured', [PropertiesController::class, 'featured']);
        Route::get('recent', [PropertiesController::class, 'recent']);
        Route::get('filters', [PropertiesController::class, 'filters']);
        Route::post('all-filtered', [PropertiesController::class, 'all']);
        Route::post('all-city-filtered', [PropertiesController::class, 'allWithCities']);
        Route::get('all-neighborhood/{id}', [PropertiesController::class, 'allWithNeighbor']);
        Route::get('details/{id}', [PropertiesController::class, 'show']);
    });
    Route::group(['prefix' => 'search'], function () {
        Route::get('/input-options', [SearchController::class, 'input']);
        Route::get('/saved', [SearchController::class, 'savedSearches']);
        Route::post('/submit', [SearchController::class, 'index']);
        Route::get('/search-results/{id}', [SearchController::class, 'savedSearchResults']);
    });
    Route::group(['prefix' => 'evaluation'], function () {
        Route::get('/input-options', [EvaluationController::class, 'inputs']);
        Route::post('/submit', [EvaluationController::class, 'store']);
    });
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/property-options', [ContactController::class, 'inputs']);
        Route::post('/submit', [ContactController::class, 'index']);
    });
});
