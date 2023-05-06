<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TimeController;

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('sign-in-or-sign-up', 'signInOrSignUp'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
});

Route::controller(MissionController::class)->prefix('mission')->group(function () {
    Route::get('get-all', 'getAll'); // restituisce la lista
    Route::post('create-or-update', 'createOrUpdate'); // crea o modifica
    Route::get('get-by-id/{id}', 'getById'); // restituisce una specifica
    Route::get('get-by-id-user/{id}', 'getByIdUser'); // restituisce una specifica
    Route::delete('delete/{id}', 'delete'); // elimina
});

Route::controller(ImageController::class)->prefix('image')->group(function () {
    Route::post('upload', 'upload'); // restituisce la lista
    Route::post('upload-video', 'uploadVideo'); // restituisce la lista
    Route::get('get-all', 'getAll'); // restituisce la lista
});

Route::controller(TimeController::class)->prefix('time')->group(function () {
    Route::get('get-time', 'getTime'); // restituisce la lista
});


