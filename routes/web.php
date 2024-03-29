<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [FullCalenderController::class, 'home'])->name('index');
Route::get('/list', [FullCalenderController::class, 'showHome']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->group(function () {

    Route::get('Agenda', [FullCalenderController::class, 'index']);

    Route::post('Agenda/action', [FullCalenderController::class, 'action']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
