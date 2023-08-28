<?php

use App\Http\Controllers\SubTaskController;
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

Route::group(['prefix' => 'task'], function () {
    Route::post('', [TaskController::class, 'store']);
    Route::get('', [TaskController::class, 'get']);
    Route::get('{id}', [TaskController::class, 'show']);
    Route::put('{id}', [TaskController::class, 'update']);
    Route::delete('{id}', [TaskController::class, 'destroy']);
});

Route::group(['prefix' => 'sub-task'], function () {
    Route::post('', [SubTaskController::class, 'store']);
    Route::get('', [SubTaskController::class, 'get']);
    Route::get('{id}', [SubTaskController::class, 'show']);
    Route::put('{id}', [SubTaskController::class, 'update']);
    Route::delete('{id}', [SubTaskController::class, 'destroy']);
});
