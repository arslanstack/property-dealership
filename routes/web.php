<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
// use App\Http\Controllers\Admin\AdminAuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route to run php artisan migrate
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'DONE'; // Return anything
});
Route::get('/migrate-refresh', function () {
    Artisan::call('migrate:refresh');
    return 'DONE'; // Return anything
});
Route::get('/migrate-rollback', function () {
    Artisan::call('migrate:rollback');
    return 'DONE'; // Return anything
});
Route::get(
    '/',
    function () {
        return redirect()->route('admin.dashboard');
    }
);

Route::get('/clearcache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
});


require 'admin.php';
