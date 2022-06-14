<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\UserApprovedMail;
use App\Models\User;
use App\Notifications\TeacherNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function notification_send(Request $request)
    {
        $student = User::find($request->student_id);
        $teacher = User::find($request->teacher_id);
        $notification = Notification::send($teacher, new TeacherNotification($student));
    }

    public function mail_send(Request $request)
    {
        $details['title'] = $request->title;
        $details['name'] = $request->name;
        $details['message'] = $request->message;
        $user = User::find($request->user_id);
        $mail = Mail::to($user->email)->send(new UserApprovedMail($details));
    }
    public function mail_send_to_admin(Request $request)
    {
        $unapproved_users = User::join('roles', 'roles.id', 'users.role_id')
            ->where('roles.name', '!=', 'admin')
            ->where('users.is_approved', 0)
            ->select('users.name', 'users.email', 'roles.name as rolename')
            ->get();
        $admin = User::where('role_id', 1)->select('email')->first();
        $details = $unapproved_users;
        Mail::to($admin->email)->send(new \App\Mail\UnapprovedUsersMail($details));
    }
}
