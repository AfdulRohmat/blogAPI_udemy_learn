<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Requests\Auth\SignInRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // SIGN UP / REGISTER
    public function signup(SignUpRequest $request)
    {

        $validateRequest = $request->validate();

        $user = User::create([
            'name' => $validateRequest["name"],
            'email' => $validateRequest["email"],
            'password' => bcrypt($validateRequest["password"]),
            'picture' => env('AVATAR_GENERATOR_URL') . $validateRequest["name"],
        ]);

        $token =  auth()->login($user);

        if (!$token) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Cannot add user'
                ], // kode
                'data' => [],
            ], 500);
        }

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User created succesfully'
            ], // kode
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'picture' => $user->picture,
                ],
                'access_token' => [
                    'token' => $token,
                    'type' => 'Bearer',
                    'epires_in' => JWTAuth::factory()->getTTL() * 24,
                ]
            ],
        ], 200);
    }

    // SIGNIN
    public function signin(SignInRequest $request)
    {
       
        $token = auth()->attempt($request->validated());
        if (!$token) {
            return response()->json([
                'meta' => [
                    'code' => 401,
                    'status' => 'error',
                    'message' => 'Incorrect email or password'
                ], // kode
                'data' => [],
            ], 401);
        }

        $user = auth()->user();

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Sign in succesfully'
            ], // kode
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'picture' => $user->picture,
                ],
                'access_token' => [
                    'token' => $token,
                    'type' => 'Bearer',
                    'epires_in' => JWTAuth::factory()->getTTL() * 24,
                ]
            ],
        ], 200);
    }
}
