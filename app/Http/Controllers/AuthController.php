<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required','min:4', ],
        ]);
        
        $user = User::create([
            'name' => $request["name"],
            'email' => $request["email"],
            'password' => bcrypt($request["name"]),
            'picture' => env('AVATAR_GENERATOR_URL') . $request["name"],
        ]);

        $token =  auth()->login($user);

        if(!$token){
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
}
