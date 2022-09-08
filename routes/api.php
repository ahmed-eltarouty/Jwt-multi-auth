<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ====================================  admin ==========================================
Route::post('/admin-login', [AdminController::class, 'login']);
Route::post('/admin-register', [AdminController::class, 'register']);

Route::group(['middleware' => 'admin-auth:admin', 'prefix' => 'auth'], function () {

    Route::post('/admin-logout', [AdminController::class, 'logout']);
    Route::post('/admin-refresh', [AdminController::class, 'refresh']);
});

// ====================================  user ==========================================

Route::post('/user-login', [UserController::class, 'login']);
Route::post('/user-register', [UserController::class, 'register']);

Route::group(['middleware' => 'auth:user', 'prefix' => 'auth'], function () {

    Route::post('/user-logout', [UserController::class, 'logout']);
    Route::post('/user-refresh', [UserController::class, 'refresh']);
});
