<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BoardController;
use Inertia\Inertia;
use App\Models\Board;

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

Inertia::share('appName', config('app.name'));
Inertia::share('boards', Board::where('user_id', 1)->get());

Route::get('/', [IndexController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
// Route::get('/boards/{id}', [BoardController::class, 'show']);
// Route::resource('boards', 'BoardController');
Route::resource('boards', BoardController::class);
// Route::controller('boards',  BoardController::class);

// BoardsController::class

/* Examples
Route::inertia('/', 'index');
Route::get('/', function () {
    // return Inertia::render('index');
    // return view('welcome');
    // Route::inertia('/about', 'About');
});
*/