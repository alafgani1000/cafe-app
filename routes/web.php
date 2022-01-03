<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransactionController;

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
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/dashboard',function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('auth/logout',[LoginController::class,'logout'])
        ->name('logout-process');

    Route::group(['middleware' => ['web']], function() {
        Route::group(['middleware' => ['role:pramuniaga']], function() {
            Route::get('/menu/makanan',[MenuController::class, 'listMakanan'])
                ->name('makanan');
            Route::get('/menu/minuman',[MenuController::class, 'listMinuman'])
                ->name('minuman');
            Route::post('/menu/order',[TransactionController::class, 'order'])
                ->name('order');
            Route::get('/menu/data-order',[TransactionController::class, 'getOrder'])
                ->name('data-order');
            Route::get('menu/count-order',[TransactionController::class, 'getCountOrder'])
                ->name('count-order');
            Route::post('menu/delete-order',[TransactionController::class, 'deleteOrder'])
                ->name('delete-order');
            Route::post('menu/update-order',[TransactionController::class, 'updateOrder'])
                ->name('update-order');
            Route::get('menu/view-cart',[TransactionController::class, 'indexOrder'])
                ->name('index-order');
            Route::post('menu/save-order',[TransactionController::class, 'saveOrder'])
                ->name('save-order');
        });
    });

    Route::group(["prefix" => "order"], function () {
        Route::get('/',[OrderController::class, 'index'])
            ->name('order.index');
        Route::get('/data',[OrderController::class, 'data'])
            ->name('order.data');
        Route::get('/{id}/detail',[OrderController::class, 'detail'])
            ->name('order.detail');
        Route::put('/{id}/checked',[OrderController::class, 'checkCook'])
            ->name('order.checked');
        Route::put('order/{id}/cancel',[TransactionController::class,'cancelOrder'])
            ->name('cancel.order');
    });

    Route::group(["prefix" => "payments"], function () {
        Route::get('/',[PaymentController::class, 'index'])
            ->name('payment.index');
        Route::get('/data',[PaymentController::class, 'data'])
            ->name('payment.data');
        Route::get('/{id}/detail',[PaymentController::class, 'detail'])
            ->name('payment.detail');
        Route::get('/{id}/order',[PaymentController::class, 'orderData'])
            ->name('payment.order');
    });

    Route::group(["prefix" => "employee"], function () {
        Route::get('/',[EmployeeController::class, 'index'])
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

