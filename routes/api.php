<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\foodsController;

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

Route::post('/foods', [foodsController::class, 'create']);
Route::get('/foods', [foodsController::class, 'index']);
Route::get('/foods/{id}',[foodsController::class, 'show']);
Route::put('/foods/{id}',[foodsController::class, 'update']);
Route::delete('/foods/{id}',[foodsController::class, 'destroy']);
