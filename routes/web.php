<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;

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

Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/', [CourseController::class, 'index']);
    Route::get('/course', [CourseController::class, 'index']);
    Route::get('/detail-course/{id}', [CourseController::class, 'detail']);
});

Route::group(['middleware' => ['auth','admin']], function(){
    Route::get('/show-all-courses', [DashboardController::class, 'showAllCourses']);
    Route::get('/tes', [CourseController::class, 'tes']);
    Route::get('/create-course', [CourseController::class, 'create']);
    Route::post('/store-course', [CourseController::class, 'store']);
    Route::get('/edit-course/{id}', [CourseController::class, 'edit']);
    Route::put('/update-course/{id}', [CourseController::class, 'update']);
    Route::get('/delete-course/{id}', [CourseController::class, 'delete']);
    Route::delete('/destroy-course/{id}', [CourseController::class, 'destroy']);
});









Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
