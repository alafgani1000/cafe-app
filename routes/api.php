<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [LoginController::class, 'signIn'])->name('signin');

Route::prefix(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function() {
    Route::post('logout',[LoginController::class, 'signOut'])->name('signout');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
