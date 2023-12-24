<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskManagementController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::get('/', function () {
    return view('task1.index');  // Removed the leading slash
});

Route::post('/tasks/store',[TaskManagementController::class,'store']);
Route::get('/task1/show',[TaskManagementController::class,'show']);
Route::get('/task1/delete/{taskId}', [TaskManagementController::class, 'delete']);
Route::get('/task1/get/{task}', [TaskManagementController::class, 'get']);
Route::get('/task1/edit/{taskId}', [TaskManagementController::class, 'edit']);
Route::post('/task1/update/{taskId}', [TaskManagementController::class, 'update']);












