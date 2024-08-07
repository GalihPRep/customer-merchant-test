<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Rewarding;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardsController extends Controller
{
    public function index()
    {
        return Reward::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reward = Reward::find($request->id);
        if (Auth::user()->point < $reward->reward) return response()->json([
            "status" => "failed",
            "reason" => "Your point is not enough!"
        ]);
        else {
            $user_id = Auth::user()->id;
            $user = User::find($user_id);
            $user->point -= $reward->point;
            $user->balance += $reward->reward;
            $user->save();
            $rewarding = new Rewarding();
            $rewarding->customer_id = $user_id;
            $rewarding->reward_id = $request->id;
            $rewarding->save();
            return response()->json([
                "status" => "success",
                "point_used" => $reward->point,
                "balance_received" => $reward->point,
            ]);
        }
    }
}
