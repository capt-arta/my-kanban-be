<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::group(['prefix' => 'task'], function () {
//     Route::post('', [TaskController::class, 'store']);
//     Route::get('', [TaskController::class, 'get']);
//     Route::get('{id}', [TaskController::class, 'show']);
//     Route::put('{id}', [TaskController::class, 'update']);
//     Route::delete('{id}', [TaskController::class, 'delete']);
// });
