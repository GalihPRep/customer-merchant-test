<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $user = User::where("email", $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "password" => "incorrect"
            ]);
        }
        return "Bearer " . $user->createToken($request->email)->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return json_encode([
            "status" => "success"
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:256",
            "email" => "required|string|email|max:256|unique:users",
            "password" => "required|string|min:8",
            "password_confirmation" => "required|string|min:8|same:password",
        ]);
        if ($validator->fails()) return response()->json([
            "status" => "error",
            "data" => $validator->errors()
        ]);
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "is_merchant" => $request->is_merchant
        ]);
        $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json([
            "status" => "success",
            "data" => [
                "user" => $user,
                "access_token" => "Bearer " . $token,
                "token_type" => "Bearer"
            ]
        ]);
    }
}
