<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-check', [LoginController::class, 'login_check']);

Route::group(['middleware' => ['auth:web','prevent']], function () {
    Route::get('/', [LoginController::class, 'dashboard']);
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/student-list', [StudentController::class, 'student_list']);
    Route::get('/student-approve/{id}', [StudentController::class, 'student_approve']);
    
    Route::get('/teacher-list', [TeacherController::class, 'teacher_list']);
    Route::get('/teacher-approve/{id}', [TeacherController::class, 'teacher_approve']);

});
