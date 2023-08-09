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
// make a auth group to put the routes in
Route::group(['middleware' => ['auth']], function () {
    Route::get('/schools', [App\Http\Controllers\SchoolController::class, 'index'])->name('schools.index');
    Route::get('/schools/create', [App\Http\Controllers\SchoolController::class, 'create'])->name('schools.create');
    Route::post('/schools', [App\Http\Controllers\SchoolController::class, 'store'])->name('schools.store');
    Route::get('/schools/{school}', [App\Http\Controllers\SchoolController::class, 'show'])->name('schools.show');
    Route::get('/schools/{school}/edit', [App\Http\Controllers\SchoolController::class, 'edit'])->name('schools.edit');
    Route::put('/schools/{school}', [App\Http\Controllers\SchoolController::class, 'update'])->name('schools.update');
    Route::delete('/schools/{school}', [App\Http\Controllers\SchoolController::class, 'destroy'])->name('schools.destroy');

    Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [App\Http\Controllers\StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}', [App\Http\Controllers\StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{student}/edit', [App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('students.destroy');
});
