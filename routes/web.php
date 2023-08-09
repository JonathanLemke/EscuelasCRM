<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// auth routes, schools
Route::get('/schools', [App\Http\Controllers\SchoolController::class, 'index'])->name('schools.index');
Route::get('/schools/create', [App\Http\Controllers\SchoolController::class, 'create'])->name('schools.create');
Route::post('/schools', [App\Http\Controllers\SchoolController::class, 'store'])->name('schools.store');
Route::get('/schools/{school}', [App\Http\Controllers\SchoolController::class, 'show'])->name('schools.show');
