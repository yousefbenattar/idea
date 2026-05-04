<?php

declare(strict_types=1);

use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('/register',[RegisterUserController::class,"create"])->middleware('guest');
Route::post('/register',[RegisterUserController::class,"store"])->middleware('guest');
Route::get('/login',[SessionController::class,"create"])->middleware('guest');
Route::post('/login',[SessionController::class,"store"])->middleware('guest');
Route::post('/logout',[SessionController::class,"destroy"])->middleware('auth');
