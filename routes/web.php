<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Livewire\IndexCourse;
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

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [CourseController::class, 'index']);
    Route::get('/course', [CourseController::class, 'index']);
    Route::get('/detail-course/{id}', [CourseController::class, 'detail']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/show-user-orders', [DashboardController::class, 'showAllUserOrders']);
    Route::get('/show-user-courses', [DashboardController::class, 'showAllUserCourses']);
    Route::get('/invoice-detail/{id}', [DashboardController::class, 'invoiceDetail']);
    Route::get('/orders/{id}', [TransactionController::class, 'orderDetail']);
    Route::post('/processing-orders/{id}', [TransactionController::class, 'orders']);
});

Route::group(['middleware' => ['auth','admin']], function(){
    Route::get('/show-all-courses', [DashboardController::class, 'showAllCourses']);
    Route::get('/show-all-orders', [DashboardController::class, 'showAllOrders']);
    Route::get('/show-approved-orders', [DashboardController::class, 'showApprovedOrders']);
    Route::delete('/delete-orders/{id}', [TransactionController::class, 'deleteOrders']);
    Route::put('/approve/{id}', [TransactionController::class, 'approve']);
    Route::put('/cancel/{id}', [TransactionController::class, 'cancel']);
    Route::get('/create-course', [CourseController::class, 'create']);
    Route::post('/store-course', [CourseController::class, 'store']);
    Route::get('/edit-course/{id}', [CourseController::class, 'edit']);
    Route::get('/edit-tags/{id}', [CourseController::class, 'editTags']);
    Route::post('/store-tags/{id}', [CourseController::class, 'storeTags']);
    Route::delete('/delete-tags/{id}', [CourseController::class, 'deleteTags']);
    Route::put('/update-tags/{id}', [CourseController::class, 'updateTags']);
    Route::put('/update-course/{id}', [CourseController::class, 'update']);
    Route::get('/delete-course/{id}', [CourseController::class, 'delete']);
    Route::delete('/destroy-course/{id}', [CourseController::class, 'destroy']);
});



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
