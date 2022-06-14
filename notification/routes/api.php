<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => '/notification'], function () {
    Route::post('/notification-send', [AdminController::class, 'notification_send']);
    Route::post('/mail-send', [AdminController::class, 'mail_send']);
    Route::get('/mail-send-to-admin', [AdminController::class, 'mail_send_to_admin']);
});
