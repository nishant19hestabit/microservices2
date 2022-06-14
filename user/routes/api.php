<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Student CRUD API's

Route::group(['prefix' => '/student'], function () {
    Route::post('/student-add', [StudentController::class, 'student_add']);
    Route::post('/student-login', [StudentController::class, 'student_login']);

    Route::group(['middleware' => ['token-check']], function () {
        Route::post('/student-detail', [StudentController::class, 'student_detail']);
        Route::post('/student-update', [StudentController::class, 'student_update']);
        Route::delete('/student-delete', [StudentController::class, 'student_delete']);
    });
});


//Teachers CRUD API's

Route::group(['prefix' => '/teacher'], function () {
    Route::post('/teacher-login', [TeacherController::class, 'teacher_login']);
    Route::post('/teacher-add', [TeacherController::class, 'teacher_add']);

    Route::group(['middleware' => ['token-check']], function () {
        Route::get('/teacher-detail', [TeacherController::class, 'teacher_detail']);
        Route::post('/teacher-update', [TeacherController::class, 'teacher_update']);
        Route::delete('/teacher-delete', [TeacherController::class, 'teacher_delete']);
    });
});


//Admin API's
Route::group(['prefix' => '/admin'], function () {
    Route::post('/admin-login', [AdminController::class, 'admin_login']);
    Route::group(['middleware' => ['token-check']], function () {
        Route::post('/assign-teacher', [AdminController::class, 'assign']);
        Route::get('/account-approve/{id}', [AdminController::class, 'account_approve']);
    });
});
