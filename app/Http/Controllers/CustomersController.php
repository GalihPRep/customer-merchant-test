<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function index() {
        $transactions = Transaction::where("merchant_id", Auth::user()->id)->get();
        $customer_ids = [];
        foreach ($transactions as $n) {
            $customer_ids[$n["customer_id"]][] = $n;
        }
        $customers = array_map(
            function ($i, $n) {
                $model = User::find($i);
                return [
                    "name" => $model->name,
                    "email" => $model->email,
                    "total_transactions" => count($n),
                    "transactions" => $n
                ];
            },
            array_keys($customer_ids),
            $customer_ids
        );
        return response()->json([
            "status" => "success",
            "total" => count($customers),
            "data" => $customers
        ]);
    }
}
