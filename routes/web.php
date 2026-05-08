<?php

declare(strict_types=1);

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StepController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// Route::view('/', 'welcome')->middleware('guest')->name("welcome");

Route::get('/', [IdeaController::class, "index"])->middleware('auth')->name("idea.index");
Route::get('/ideas/{idea}', [IdeaController::class, "show"])->middleware('auth')->name('ideas.show');
Route::delete('/ideas/{idea}', [IdeaController::class, "destroy"])->middleware('auth')->name("idea.destroy");
Route::post('/idea/store', [IdeaController::class, "store"])->middleware('auth')->name('idea.store')
;
Route::patch('/ideas/{idea}', [IdeaController::class, "update"])->middleware('auth')->name('ideas.update');

Route::patch('/steps/{step}', [StepController::class, "update"])->middleware('auth')->name('steps.update');


Route::get('/register', [RegisterUserController::class, "create"])->middleware('guest');
Route::post('/register', [RegisterUserController::class, "store"])->middleware('guest');
Route::get('/login', [SessionController::class, "create"])->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, "store"])->middleware('guest');
Route::post('/logout', [SessionController::class, "destroy"])->middleware('auth');
