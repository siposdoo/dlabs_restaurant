<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'role' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $user = User::where('username', $request->username)->where('role', $request->role)->get()->first();

        if ($user) {
            $auth_token = $user->createToken('authToken')->plainTextToken;
            $data = [
                'bearer_token' => $auth_token ?? null
            ];

            return response()->json($data, 200);      
          } else {
            return $this->errorResponse(["Invalid Login Credentials!"]);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'role' => 'required|string'

        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        try {
            $input = [
                'username' => $request->username,
                'role' => $request->role

            ];

            $user = new User($input);
            $user->save();
            if (isset($request->role)) {
                $user->assignRole($request->role);
            } else {
                $user->assignRole('Customer');
            }

            $data = [
                'user' => [
                    'username' => $user->username,
                    'role' => $user->role,

                ]
            ];

            return $this->successResponse($data);
        } catch (\Throwable $e) {
            
            return $this->errorResponse($e, 404);
        }
    }
    public function successResponse($data, $status_code = 200, $message = null)
    {
        $error = [
            "code" => $status_code,
            "message" => $message,
            "data" => $data
        ];
        return response()->json($error, $status_code);
    }
    public function checkRole()
    {
        $data['role'] = Auth::user()->roles->pluck("name")->first();
        return $this->successResponse($data, 201);
    }
    public function errorResponse($errors, $status_code = 400, $message = null)
    {
        $error = [
            "code" => $status_code,
            "message" => $message,
            "data" => null,
            "errors" => $errors,
        ];
        return response()->json($error, $status_code);
    }

    public function validationFailed($input_errors, $message = null, $status_code = 400)
    {
        $errors = [];
        foreach ($input_errors->all() as $msg) {
            array_push($errors, $msg);
        }
        return $this->errorResponse($errors, $status_code, $message);
    }
}
