<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardApplicationController;
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

Route::post('/register', [AuthController::class, 'register']);
$limiter = config('fortify.limiters.login') ?: 100;
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('dashboard-report', [CardApplicationController::class, 'dashboardReport']);
    Route::get('user', [AuthController::class, 'user']);
    Route::get('users/search', [UserController::class, 'search']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('departments', \App\Http\Controllers\DepartmentController::class);
    Route::apiResource('card-category', \App\Http\Controllers\CardCategoryController::class);
    Route::put('card-applications/toggle/{cardApplication}', [CardApplicationController::class, 'toggle']);
    Route::apiResource('card-applications', \App\Http\Controllers\CardApplicationController::class);
});

