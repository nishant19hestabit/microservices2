<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTController extends Controller
{
    public function token_generate(Request $request)
    {
        $response['status'] = false;
        $response['message'] = '';
        $response['data'] = '';
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'role_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if (count($errors) > 0) {
                $response['message'] = 'validation_error';
                $response['data'] = $errors->first();
                return Response::json($response, 400);
            }
        } else {

            $token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => $request->role_id]);
            if (!$token) {
                $response['message'] = 'Token Generate Error';
                return Response::json($response);
            } else {
                $response['status'] = true;
                $response['message'] = 'Token Generated Successfully';
                $response['data'] = $token;
                return Response::json($response);
            }
        }
    }

    public function token_decrypt(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => ''];

        try {
            $logged_user = JWTAuth::user();
            $response['status'] = true;
            $response['message'] = 'Data found';
            $response['data'] = $logged_user;
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
    public function token_expire(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => ''];

        try {
            $forever = true;
            JWTAuth::parseToken()->invalidate($forever);
            $response['status'] = true;
            $response['message'] = 'Token Expire Successfully';
            $response['data'] = '';
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
}
