<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function show()
    {
        $model = Auth::user();
        return response()->json([
            "name" => $model->name,
            "email" => $model->email,
            "balance" => $model->balance,
            "point" => $model->point
        ]);
    }

    public function topup(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "password" => "incorrect"
            ]);
        }
        if (!$request->amount) {
            throw ValidationException::withMessages([
                "amount" => "none"
            ]);
        }
        $model = User::find($user->id);
        $model->balance = $model->balance + $request->amount;
        $model->save();
        return response()->json([
            "status" => "success",
            "amount" => $request->amount
        ]);
    }
}
