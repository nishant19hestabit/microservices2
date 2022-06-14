<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\JWTController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'jwt'], function () {

    Route::post('/token-genrate', [JWTController::class, 'token_generate']);
    Route::post('/token-decrypt', [JWTController::class, 'token_decrypt'])->middleware('jwt.verify');
    Route::post('/token-expire', [JWTController::class, 'token_expire'])->middleware('jwt.verify');
    
    // Route::group(['middleware' => ['jwt.verify']], function () {
    //     Route::get('/student-detail', [StudentController::class, 'student_detail']);
    //     Route::post('/student-update', [StudentController::class, 'student_update']);
    //     Route::delete('/student-delete', [StudentController::class, 'student_delete']);
    // });
});
