<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\UserApproveMail;
use App\Models\Roles;
use App\Models\User;
use App\Notifications\AssignTeacherNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public $jwt_url;
    public $notification_url;
    public function __construct()
    {
        $this->jwt_url = config('global.jwt_url');
        $this->notification_url = config('global.notification_url');
    }

    public function admin_login(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => ''];

        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                if (count($errors) > 0) {
                    $response['message'] = 'validation_error';
                    $response['data'] = $errors->first();
                    return Response::json($response, 400);
                }
            } else {
                $role = Roles::where('name', 'admin')->first();
                $token = Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => $role->id]);
                if (!$token) {
                    $response['message'] = 'Invalid Credentials';
                    return Response::json($response);
                } else {
                    $api_response = Http::post($this->jwt_url . '/api/jwt/token-genrate', [
                        'email' => $request->email,
                        'password' => $request->password,
                        'role_id' => $role->id,
                    ]);
                    $user = Auth::user();
                    $admin = User::where('id', $user->id)->select('id', 'name', 'email', 'role_id')->first();
                    $admin['role'] = $role->name;
                    $admin['token'] = $api_response['data'];
                    $response['status'] = true;
                    $response['message'] = 'Login Successfully';
                    $response['data'] = $admin;
                    return Response::json($response);
                }
            }
        }
        //catch exception
        catch (Exception $e) {
            $response['message'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function assign(Request $request)
    {
        $response = [
            'status' => false,
            'message' => '',
            'data' => ''
        ];
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if (count($errors) > 0) {
                $response['message'] = 'validation_error';
                $response['data'] = $errors->first();
                return Response::json($response, 400);
            }
        }
        try {

            $header = $request->header('Authorization');
            $api_response = Http::withHeaders([
                'Authorization' => $header,
            ])->post($this->jwt_url . '/api/jwt/token-decrypt');
            
            if ($api_response['status'] == true) {
                
                $admin = $api_response['data'];
                $role_id = $admin['role_id'];
                $role = Roles::find($role_id);
                if ($role->id != 1) {
                    $response['status'] = false;
                    $response['message'] = 'Access denied! You can not assigned the teacher';
                    $response['data'] = '';
                    return Response::json($response);
                } else {

                    $student_role = Roles::where('name', 'student')->first();
                    $teacher_role = Roles::where('name', 'teacher')->first();
                    $student = User::where([
                        'id' => $request->student_id,
                        'role_id' => $student_role->id
                    ])->first();

                    if (empty($student)) {
                        $response['message'] = 'Wrong student id';
                        return Response::json($response);
                    }
                    $teacher = User::where([
                        'id' => $request->teacher_id,
                        'role_id' => $teacher_role->id
                    ])->first();
                    if (empty($teacher)) {
                        $response['message'] = 'Wrong teacher id';
                        return Response::json($response);
                    }
                    $student->teacher_assigned = $request->teacher_id;
                    $student->save();
                    $student['assigned_teacher_name'] = $teacher->name;
                    $response['status'] = true;
                    $response['message'] = 'Teacher Assigned successfully';
                    $response['data'] = $student;
            
                    $notification_response = Http::post($this->notification_url . '/api/notification/notification-send', [
                        'student_id' => $request->student_id,
                        'teacher_id' => $request->teacher_id,
                    ]);
                    return Response::json($response);
                }
            } else {
                $response['status'] = $api_response['status'];
                $response['message'] = $api_response['message'];
                $response['data'] = $api_response['data'];
            }
            return Response::json($response);
        }
        //catch exception
        catch (Exception $e) {
            $response['status'] = false;
            $response['message'] = $e->getMessage();
            $response['data'] = '';
            return Response::json($response);
        }
    }

    public function account_approve(Request $request)
    {
        $response = [
            'status' => false,
            'message' => '',
            'data' => ''
        ];
        try {
            $id = $request->id;
            $user = User::where('role_id', '!=', 1)->where('id', $id)->first();
            if (empty($user)) {
                $response['message'] = 'id is wrong';
                return Response::json($response);
            }
            if ($user->is_approved == 1) {
                $response['message'] = 'Already approved';
                $response['data'] = $user;
                return Response::json($response);
            } else {
                $user->is_approved = 1;
                $user->save();
                $response['status'] = true;
                $response['message'] = 'Approved successfully';
                $response['data'] = $user;
                $details['title'] = 'Approved';
                $details['name'] = $user->name;
                $details['message'] = 'Your account has been approved';
                $mail_response = Http::post($this->notification_url . '/api/notification/mail-send', [
                    'title' => $details['title'],
                    'name' => $details['name'],
                    'message' => $details['message'],
                    'user_id' => $user->id,
                ]);
                return Response::json($response);
            }
        } catch (Exception $e) {
            $response['status'] = false;
            $response['message'] = $e->getMessage();
            $response['data'] = '';
            return Response::json($response);
        }
    }
}
