<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\PunishController;
use App\Http\Controllers\PunishmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/signin', [UserController::class, 'signin']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/signup', [UserController::class, 'signup']);
Route::get('/home', function(){
    return view('index', ['title' => 'Home']);
})->name('home')->middleware('auth');

Route::resource('/books', BookController::class)->middleware('auth');
Route::resource('/histories', HistoryController::class)->except('show')->middleware('auth');
Route::resource('/categories', CategoryController::class)->except('show')->middleware('auth');
Route::resource('/authors', AuthorController::class)->except('show')->middleware('auth');
Route::resource('/publishers', PublisherController::class)->except('show')->middleware('auth');
Route::resource('/punishes', PunishController::class)->except('show')->middleware('auth');
Route::resource('/punishments', PunishmentController::class)->except('show')->middleware('auth');