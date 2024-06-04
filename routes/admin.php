<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'  =>  'admin'], function () {
	Route::get('login', [AdminLoginController::class, 'index'])->name('login');
	Route::post('verify_login', [AdminLoginController::class, 'verify_login']);
	Route::get('logout', [AdminLoginController::class, 'logout']);

	Route::group(['middleware' => ['auth:admin']], function () {

		Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
		Route::get('admin', [AdminController::class, 'index']);
		Route::get('change_password', [AdminController::class, 'change_password']);
		Route::post('update_password', [AdminController::class, 'update_password']);

		Route::group(['prefix'  =>  'users'], function () {
			Route::get('/', [UserController::class, 'index']);
			Route::post('update_statuses', [UserController::class, 'update_statuses']);
			Route::get('detail/{id}', [UserController::class, 'user_details']);
		});
		Route::group(['prefix'  =>  'features'], function () {
			Route::get('/', [FeatureController::class, 'index']);
			Route::post('/store', [FeatureController::class, 'store']);
			Route::post('/feature-show', [FeatureController::class, 'show']);
			Route::post('/update-feature', [FeatureController::class, 'update']);
			Route::post('/delete', [FeatureController::class, 'delete']);
		});
	});
});
