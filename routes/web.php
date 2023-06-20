<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BatchCoursesController;
use App\Http\Controllers\BatchUsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IkutiAngkatanController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\TaskController;
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
    return view('index');
})->name('home')->middleware('guest');

Route::get('/sambutan', function () {
    return view('sambutan');
})->name('sambutan')->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/comingsoon', function () {
    return view('comingsoon');
})->name('comingsoon');

Route::controller(AuthController::class)->group(function () {
    Route::get('/signin', 'signin')->name('auth.signin')->middleware(['guest']);
    Route::get('/signup', 'signup')->name('auth.signup')->middleware(['guest']);
    Route::post('/signup', 'store')->name('auth.store');
    Route::post('/signin', 'authenticate')->name('auth.authenticate');
    Route::post('/signout', 'signout')->name('auth.signout');
});

Route::resource('/user', UserController::class)->middleware(['auth', 'admin.instruktur']);

Route::resource('/me', MeController::class)->middleware(['auth']);

Route::resource('/categories', CategoryController::class)->middleware(['auth', 'admin']);

Route::resource('/courses', CourseController::class)->middleware(['auth']);

Route::resource('/materis', MateriController::class)->middleware(['auth']);

Route::resource('/batches', BatchController::class)->middleware(['auth']);
Route::get('/batches-courses-show/{id}', [BatchController::class, 'show_course'])->name('batches-courses-show')->middleware('auth');

Route::resource('/batches-courses', BatchCoursesController::class)->middleware(['auth', 'admin'])->except(['batches-courses.create']);
Route::get('/batches-courses/create/{id}', [BatchCoursesController::class, 'create'])->name('batches-courses.create')->middleware(['auth', 'admin']);

Route::resource('/batches-users', BatchUsersController::class)->middleware(['auth', 'admin'])->except(['batches-users.create']);
Route::get('/batches-users/create/{id}', [BatchUsersController::class, 'create'])->name('batches-users.create')->middleware(['auth', 'admin']);

Route::resource('/tasks', TaskController::class)->middleware(['auth']);

Route::resource('/ikuti', IkutiAngkatanController::class)->middleware(['auth']);
