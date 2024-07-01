<?php

use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\PackageController;
use App\Http\Controllers\backend\PackagelistController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//DashBoard Route
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard.index')
    ->middleware(['auth', 'admin']);

//Profile Route
Route::controller(ProfileController::class)
    ->prefix('profile/')->name('profile.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('update', 'update')->name('update');
    });

//Users Route
Route::controller(UserController::class)
    ->prefix('user/')
    ->name('user.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('fetch', 'fetch')->name('fetch');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('active/{id}', 'active')->name('active');
        Route::get('deActive/{id}', 'deActive')->name('deActive');
        Route::delete('delete/{id}', 'delete')->name('delete');
    });

//Package Route
Route::controller(PackageController::class)
    ->prefix('package/')
    ->name('package.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('active/{id}', 'active')->name('active');
        Route::get('deActive/{id}', 'deActive')->name('deActive');
        Route::delete('delete/{id}', 'delete')->name('delete');
    });

//Package List Route
Route::controller(PackagelistController::class)
    ->prefix('packageList/')
    ->name('packageList.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('active/{id}', 'active')->name('active');
        Route::get('deActive/{id}', 'deActive')->name('deActive');
        Route::delete('delete/{id}', 'delete')->name('delete');
    });

//REport Route
Route::controller(ReportController::class)
    ->prefix('report/')
    ->name('report.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('sorting', 'sorting')->name('sorting');
    });

Route::get('notification', [ReportController::class, 'notification'])->name('notification');
Route::get('notification/renew/{id}', [ReportController::class, 'renew'])->name('notification.renew');
Route::post('notification/update/{id}', [ReportController::class, 'renewUpdate'])->name('notification.update');
