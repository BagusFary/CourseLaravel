<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

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

// Route Course
Route::get('/', [CourseController::class, 'index']);
Route::get('/course', [CourseController::class, 'index']);
Route::get('/create-course', [CourseController::class, 'create']);
Route::post('/store-course', [CourseController::class, 'store']);
Route::get('/edit-course/{id}', [CourseController::class, 'edit']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
