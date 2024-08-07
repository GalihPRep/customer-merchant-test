<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_merchant) {
            $model = new Product();
            $model->merchant_id = Auth::user()->id;
            $model->name = $request->name;
            $model->price = $request->price;
            $model->save();
            return response()->json([
                "status" => "success",
                "data" => $model
            ]);
        } else return response()->json([
            "status" => "unauthorized"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->is_merchant) {
            $model = Product::find($id);
            if ($request->name) $model->name = $request->name;
            if ($request->price) $model->price = $request->price;
            $model->save();
            return response()->json([
                "status" => "success",
                "data" => $model
            ]);
        } else return response()->json([
            "status" => "unauthorized"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->is_merchant) {
            $model = Product::find($id);
            $model->delete();
            return response()->json([
                "status" => "success"
            ]);
        } else return response()->json([
            "status" => "unauthorized"
        ]);
    }
}
