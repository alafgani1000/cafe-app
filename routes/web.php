<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/login',[LoginController::class,'index'])
    ->name('login');
Route::post('auth/login',[LoginController::class,'store'])
    ->name('login-proccess');

Route::group(["middleware" => "auth"], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::group(["prefix" => "employee"], function () {
        Route::get('/', [EmployeeController::class, 'index'])
            ->name('employee.index');
        Route::post('/',[EmployeeController::class, 'store'])
            ->name('employee.store');
        Route::get('/data',[EmployeeController::class, 'data'])
            ->name('employee.data');
        Route::get('/{id}/edit',[EmployeeController::class, 'edit'])
            ->name('employee.edit');
        Route::put('/{id}/update',[EmployeeController::class, 'update'])
            ->name('employee.update');
        Route::delete('/{id}/delete',[EmployeeController::class, 'delete'])
            ->name('employee.delete');

    });

    Route::group(['prefix' => 'cafe'], function() {
        Route::get('/',[CafeController::class, 'index'])
            ->name('cafe.index');
        Route::post('/',[CafeController::class, 'store'])
            ->name('cafe.store');
        Route::get('/data',[CafeController::class, 'data'])
            ->name('cafe.data');
        Route::get('/{id}/edit',[CafeController::class, 'edit'])
            ->name('cafe.edit');
        Route::put('/{id}/update',[CafeController::class, 'update'])
            ->name('cafe.update');
        Route::delete('/{id}/delete',[CafeController::class, 'delete'])
            ->name('cafe.delete');
    });

    Route::group(['prefix' => 'category'], function() {
        Route::get('/',[CategoryController::class, 'index'])
            ->name('category.index');
        Route::post('/',[CategoryController::class, 'store'])
            ->name('category.store');
        Route::get('/data',[CategoryController::class, 'data'])
            ->name('category.data');
        Route::get('/{id}/edit',[CategoryController::class, 'edit'])
            ->name('category.edit');
        Route::put('/{id}/update',[CategoryController::class, 'update'])
            ->name('category.update');
        Route::delete('/{id}/delete',[CategoryController::class, 'delete'])
            ->name('category.delete');
    });

    Route::group(['prefix' => 'menu'], function() {
        Route::get('/',[MenuController::class, 'index'])
            ->name('menu.index');
        Route::post('/',[MenuController::class, 'store'])
            ->name('menu.store');
        Route::get('/data',[MenuController::class, 'data'])
            ->name('menu.data');
        Route::get('/{id}/edit',[MenuController::class, 'edit'])
            ->name('menu.edit');
        Route::put('/{id}/update',[MenuController::class, 'update'])
            ->name('menu.update');
        Route::delete('/{id}/delete',[MenuController::class, 'delete'])
            ->name('menu.delete');
    });

    Route::group(['prefix' => 'table'], function() {
        Route::get('/',[TableController::class, 'index'])
            ->name('table.index');
        Route::get('/data',[TableController::class, 'data'])
            ->name('table.data');
        Route::post('/',[TableController::class, 'store'])
            ->name('table.store');
        Route::get('/{id}/edit',[TableController::class, 'edit'])
            ->name('table.edit');
        Route::put('/{id}/update',[TableController::class, 'update'])
            ->name('table.update');
        Route::delete('/{id}/delete',[TableController::class, 'delete'])
            ->name('table.delete');
    });
});

