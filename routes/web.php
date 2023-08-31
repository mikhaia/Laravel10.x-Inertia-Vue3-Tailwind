<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BoardController;

use App\Http\Controllers\User\SteamAuthController;
use App\Http\Controllers\User\GoogleAuthController;
use App\Http\Controllers\User\AuthController;
use Inertia\Inertia;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
Inertia::share('toast.success', fn() => session()->get('success'));
Inertia::share('toast.error', fn() => session()->get('error'));
/*
Inertia::share('toast', function() { 
  if(session()->get('errors')) return session()->get('errors')->all();
});
*/


Route::get('auth', [AuthController::class, 'index'])->name('login');
Route::post('auth', [AuthController::class, 'login']);
Route::get('steam', SteamAuthController::class);
Route::get('google', GoogleAuthController::class);
Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
  
  // TODO: avoid routes in migratations
  Inertia::share('boards', Board::where('user_id', 1)->get());
  Inertia::share('user', fn() => Auth::user());

  Route::get('/', [IndexController::class, 'index']);
  Route::get('/users/{user}', [UserController::class, 'show']);
  Route::resource('boards', BoardController::class);
});
