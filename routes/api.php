<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColaboratorController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//CRUD Routes
Route::middleware(['auth:api'])->
    get('/colaborator', [ColaboratorController::class, 'index']);

Route::middleware(['auth:api'])->
    get('/find-colaborator/{id}', [ColaboratorController::class, 'FindColaborator']);

Route::middleware(['auth:api'])->
    post('/colaborator/status', [ColaboratorController::class, 'SelectByStatus']);

Route::middleware(['auth:api'])->
    put('/update-colaborator-info/{id}', [ColaboratorController::class, 'UpdateColaboratorInfo']);

Route::middleware(['auth:api'])->
    delete('/delete-colaborator/{id}', [ColaboratorController::class, 'DeleteColaborator']);

Route::middleware(['auth:api'])->
    post('/create-colaborator', [ColaboratorController::class, 'CreateColaborator']);

// JWT Routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
});