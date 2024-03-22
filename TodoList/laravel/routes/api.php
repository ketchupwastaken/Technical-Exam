<?php

use App\Http\Controllers\TodoController;
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


Route::get('get',[TodoController::class,'getTodo']);
Route::post('add',[TodoController::class,'store']);
Route::get('{id}/edit',[TodoController::class,'edit']);
Route::put('{id}/edit',[TodoController::class,'update']);


Route::delete('{id}/delete', [TodoController::class,'delete']);



