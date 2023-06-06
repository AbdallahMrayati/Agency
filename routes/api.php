<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\PricingController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\SubscriptionsController;
use App\Http\Controllers\API\TagController;
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

Route::controller(LoginController::class)->group(function () {
    Route::post('login', 'login');
});
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('posts', PostController::class);
    Route::resource('prices', PricingController::class);
    Route::resource('tags', TagController::class);
    Route::resource('requests', RequestController::class);
    Route::resource('subscriptions', SubscriptionsController::class);
});
