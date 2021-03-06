<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecordController;
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

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('users', [AuthController::class, 'check']);

    Route::post('create', [RecordController::class, 'create']);

    Route::get('record/{id}', [RecordController::class, 'show']);

    Route::post('record/edit/{id}', [RecordController::class, 'edit']);

    Route::post('record/delete/{id}', [RecordController::class, 'delete']);

    Route::get('my-records',[RecordController::class, 'myRecords']);

    Route::get('all-records',[RecordController::class, 'allRecords']);

});