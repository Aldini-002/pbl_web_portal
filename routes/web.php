<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MeController;
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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::controller(AuthController::class)->group(function () {
    Route::get('/signin', 'signin')->name('auth.signin')->middleware(['guest']);
    Route::get('/signup', 'signup')->name('auth.signup')->middleware(['guest']);
    Route::post('/signup', 'store')->name('auth.store');
    Route::post('/signin', 'authenticate')->name('auth.authenticate');
    Route::post('/signout', 'signout')->name('auth.signout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('user.index')->middleware(['auth']);
    Route::get('/users/{id}', 'show')->name('user.show')->middleware(['auth']);
    Route::put('/users/{id}', 'update')->name('user.update')->middleware(['auth']);
    Route::delete('/users/{id}', 'destroy')->name('user.destroy')->middleware(['auth']);
});

Route::controller(MeController::class)->group(function () {
    Route::get('/me', 'index')->name('me.index')->middleware(['auth']);
    Route::put('/me/{id}', 'update')->name('me.update')->middleware(['auth']);
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index')->middleware(['auth']);
    Route::put('/categories/{id}', 'update')->name('categories.update')->middleware(['auth']);
    Route::post('/categories', 'store')->name('categories.store')->middleware(['auth']);
    Route::delete('/categories/{id}', 'destroy')->name('categories.destroy')->middleware(['auth']);
});

Route::controller(CourseController::class)->group(function () {
    Route::get('/courses', 'index')->name('courses.index')->middleware(['auth']);
    Route::get('/courses/create', 'create')->name('courses.create')->middleware(['auth']);
    Route::get('/courses/{id}', 'show')->name('courses.show')->middleware(['auth']);
    Route::get('/courses/edit/{id}', 'edit')->name('courses.edit')->middleware(['auth']);
    Route::put('/courses/{id}', 'update')->name('courses.update')->middleware(['auth']);
    Route::post('/courses', 'store')->name('courses.store')->middleware(['auth']);
    Route::delete('/courses/{id}', 'destroy')->name('courses.destroy')->middleware(['auth']);
});

// Route::controller(CourseController::class)->group(function () {
//     Route::get('/materis', 'index')->name('materis.index')->middleware(['auth']);
//     Route::get('/materis/create', 'create')->name('materis.create')->middleware(['auth']);
//     Route::get('/materis/{id}', 'show')->name('materis.show')->middleware(['auth']);
//     Route::get('/materis/edit/{id}', 'edit')->name('materis.edit')->middleware(['auth']);
//     Route::put('/materis/{id}', 'update')->name('materis.update')->middleware(['auth']);
//     Route::post('/materis', 'store')->name('materis.store')->middleware(['auth']);
//     Route::delete('/materis/{id}', 'destroy')->name('materis.destroy')->middleware(['auth']);
// });

Route::resource('/materis', MateriController::class)->middleware(['auth']);
