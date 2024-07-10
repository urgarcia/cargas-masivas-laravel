<?php

namespace App\Http\Controllers;

use App\Models\RolUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'userType' => 'required|integer|digits:1|max:3|min:1'
            ]);
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'userType' => $request->userType,
            ]);
            RolUser::create([
                'user_id'=> $user->id,
                'role_id'=> $request->userType,
            ]);
            
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Throwable $th) {
            
            return response()->json(['message' => $th], 500);
        }

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $request->user()->createToken('Personal Access Token');
        return response()->json($token, 200);

    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if($user){
            $user->token()->revoke();

            return response()->json(['message' => 'Successfully logged out']);
        }
        return response()->json(['message' => 'User not authenticated'], 401);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
