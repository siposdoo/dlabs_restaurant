<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ResponseHelper;


class AuthController extends Controller
{
    use ResponseHelper;

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

            
            return $this->successResponse($user);
        } catch (\Throwable $e) {
            
            return response()->json($e, 404);        }
    }
   
    public function checkRole()
    {
        $data['role'] = Auth::user()->roles->pluck("name")->first();
        return $this->successResponse($data, 201);
    }
   
}
