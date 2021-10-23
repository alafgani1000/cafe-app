<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;

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
        Route::get('/data',[EmployeeController::class, 'edit'])
            ->name('employee.edit');
        Route::put('/{id}/update',[EmployeeController::class, 'update'])
            ->name('employee.update');
        Route::delete('/{id}/delete',[EmployeeController::class, 'delete'])
            ->name('employee.delete');

    });
});

