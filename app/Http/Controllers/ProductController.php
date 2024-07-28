<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json(['message' => 'success fetch all data', 'count' => count($products), 'data' => $products, 'status' => 200], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'barcode' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'category_id' => 'required',
            ]);
            $product = Product::create($validated);
            return response()->json(['message' => 'success creating data', 'data' => $product, 'status' => 201], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($identifier)
    {
        try {
            $product = Product::with('category')
                ->where('id', '=', $identifier)
                ->orWhere('barcode', '=', $identifier)
                ->get()->first();
            if ($product) {
                return response()->json(['message' => 'success fetching data', 'data' => $product, 'status' => 200], 200);
            } else {
                return response()->json(['message' => 'Product not found', 'data' => null], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }

    public function search(Request $request)
    {
        try {
            $product = Product::with('category')
                ->where('name', 'like', '%' . $request->query('keyword') . '%')
                ->orWhere('price', '=', $request->query('keyword'))
                ->orWhere('quantity', '=', $request->query('keyword'))
                ->get();
            if ($product) {
                return response()->json(['message' => 'success searching data', 'data' => $product, 'status' => 200], 200);
            } else {
                return response()->json(['message' => 'Product not found', 'data' => null], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $product->update($request->all());
            return response()->json(
                [
                    'message' => 'success modified data',
                    'data' => $product,
                    'status' => 202
                ],
                202
            );
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(
                [
                    'message' => 'success deleted data',
                    'data' => null,
                    'status' => 200
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}
