<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class StudentController extends Controller
{
    public function student_add(Request $request)
    {
        $response = [
            'status' => false,
            'message' => '',
            'data' => ''
        ];
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'address' => 'required',
                'profile_picture' => 'mimes:jpeg,jpg,png,gif|required|max:3000',
                'current_school' => 'required|string|max:255',
                'previous_school' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                if (count($errors) > 0) {
                    $response['message'] = 'validation_error';
                    $response['data'] = $errors->first();
                    return Response::json($response, 400);
                }
            } else {
                $image = $request->profile_picture;
                if ($image) {
                    $base_url = URL::to('/');
                    $file = $request->profile_picture;
                    $extention = $file->getClientOriginalExtension();
                    $filename = time() . rand(0, 999) . '.' . $extention;
                    $publicPath = public_path('uploads/students');
                    $file->move($publicPath, $filename);
                    $db =  $base_url . '/uploads/students/' . $filename;
                } else {
                    $db = null;
                }
                $role = Roles::where('name', 'student')->first();
                if (empty($role)) {
                    $response['message'] = 'student role is missing';
                    return Response::json($response);
                }
                $student = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                    'profile_picture' => $db,
                    'current_school' => $request->current_school,
                    'previous_school' => $request->previous_school,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'role_id' => $role->id,
                    'is_approved' => 0,
                ]);
                if (!$student) {
                    $response['message'] = 'something went wrong during adding student';
                    return Response::json($response);
                } else {
                    unset($student['experience']);
                    unset($student['expertise_subject']);
                    $response['status'] = true;
                    $response['message'] = 'Student Added Successfully';
                    $response['data'] = $student;
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
    public function student_detail(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => ''];
        try {
            $student = JWTAuth::user();
            $role=Roles::where('id',$student->role_id)->first();
            $student['role']=$role->name;
            unset($student['experience']);
            unset($student['expertise_subject']);
            $response['status'] = true;
            $response['message'] = 'Student details found successfully';
            $response['data'] = $student;
            return Response::json($response);
        }
        //catch exception
        catch (Exception $e) {
            $response['message'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function student_update(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => ''];
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'address' => 'required',
                'current_school' => 'required|string|max:255',
                'previous_school' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                if (count($errors) > 0) {
                    $response['message'] = 'validation_error';
                    $response['data'] = $errors->first();
                    return Response::json($response, 400);
                }
            } else {
                $logged_user = JWTAuth::user();
                $user = User::find($logged_user->id);
                $image = $request->profile_picture;
                if ($image) {
                    $base_url = URL::to('/');
                    $file = $request->profile_picture;
                    $extention = $file->getClientOriginalExtension();
                    $filename = time() . rand(0, 999) . '.' . $extention;
                    $publicPath = public_path('uploads/students');
                    $file->move($publicPath, $filename);
                    $db =  $base_url . '/uploads/students/' . $filename;
                    $user->profile_picture = $db;
                }

                $user->name = $request->name;
                $user->address = $request->address;
                $user->current_school = $request->current_school;
                $user->previous_school = $request->previous_school;
                $user->father_name = $request->father_name;
                $user->mother_name = $request->mother_name;
                $user->save();
                unset($user['experience']);
                unset($user['expertise_subject']);
                $response['status'] = true;
                $response['message'] = 'Student details updated successfully';
                $response['data'] = $user;
                return Response::json($response);
            }
        }
        //catch exception
        catch (Exception $e) {
            $response['message'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function student_delete(Request $request)
    {
        $response = ['status' => false, 'message' => ''];

        try {
            $logged_user_id = JWTAuth::user()->id;
            $forever = true;
            JWTAuth::parseToken()->invalidate($forever);
            User::where('id', $logged_user_id)->delete();
            $response['status'] = true;
            $response['message'] = 'Student deleted successfully';
            return Response::json($response);
        }
        //catch exception
        catch (Exception $e) {
            $response['message'] = $e->getMessage();
            return Response::json($response);
        }
    }
    public function student_login(Request $request)
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
                $role = Roles::where('name', 'student')->first();
                $token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => $role->id]);
                if (!$token) {
                    $response['message'] = 'Invalid Credentials';
                    return Response::json($response);
                } else {
                    $student = JWTAuth::user();
                    $student['role'] = $role->name;
                    $student['token'] = $token;
                    $response['status'] = true;
                    $response['message'] = 'Login Successfully';
                    $response['data'] = $student;
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
}
