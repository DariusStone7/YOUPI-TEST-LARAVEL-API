<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/user')->controller(AuthController::class)->group(function(){
    Route::post('/create', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::prefix('/task')->middleware('auth:sanctum')->controller(TaskController::class)->group(function(){
    Route::get('/all', 'index');
    Route::post('/create', 'store');
    Route::put('/update/{id}', 'update');
    Route::get('show/{id}', 'show');
    Route::delete('/delete/{id}', 'destroy');
});
