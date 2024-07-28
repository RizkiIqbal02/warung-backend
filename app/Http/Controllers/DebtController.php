<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Debtor;
use App\Models\Product;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $debt = Debt::get();
            return response()->json([
                'message' => 'debt retrieved successfully',
                'data' => $debt,
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 500,
            ]);
        }
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
            $request->validate([
                'product_id' => 'required',
                'debtor_id' => 'required',
                'quantity' => 'required',
            ]);
            $product = Product::find($request->product_id);

            $debtor = Debtor::find($request->debtor_id);
            $debtor->update(['total' => $debtor->total + ($product->price * $request->quantity)]);
            $debtor->save();

            $debt = Debt::create([
                'product_id' => $request->product_id,
                'debtor_id' => $request->debtor_id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
            return response()->json(['message' => 'success creating data', 'data' => $debt, 'status' => 201], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
        try {
            if ($debt) {
                return response()->json(['message' => 'success fetching data', 'data' => $debt->with('product', 'debtor')->find($debt->id), 'status' => 200], 200);
            } else {
                return response()->json(['message' => 'debt not found', 'data' => null], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        try {
            $debtor = Debtor::find($debt->debtor_id);
            $debtor->update(['total' => $debtor->total - ($debt->price * $debt->quantity)]);
            $debtor->save();
            $debt->delete();
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
