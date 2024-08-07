<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TransactionsController extends Controller
{
    public function store(Request $request) {
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "password" => "incorrect"
            ]);
        }
        $models = [];
        foreach ($request->products as $n) {
            $model = new Transaction();
            $product = Product::find($n["id"]);
            $model->customer_id = Auth::user()->id;
            $model->merchant_id = $product->merchant_id;
            $model->product_id = $product->id;
            $model->quantity = $n["quantity"];
            $model->cost = $product->price * $n["quantity"];
            $model->save();
            $models[] = $model;
            $customer = User::find($model->customer_id);
            $customer->balance -= $model->cost;
            $customer->point += 1;
            $customer->save();
            $merchant = User::find($model->merchant_id);
            $merchant->balance += $model->cost;
            $merchant->save();
        }
        return response()->json([
            "status" => "success",
            "total_cost" => array_sum(array_map(fn ($n) => $n->cost, $models)),
            "data" => $models
        ]);
    }
}
