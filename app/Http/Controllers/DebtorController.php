<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $debtor = Debtor::get();
            return response()->json([
                'message' => 'debtor retrieved successfully',
                'data' => $debtor,
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
                'name' => 'required',
                'gender' => 'required',
                'total' => 'required'
            ]);
            $debtor = Debtor::create($request->all());
            return response()->json(['message' => 'success creating data', 'data' => $debtor, 'status' => 201], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Debtor $debtor)
    {
        try {
            if ($debtor) {
                return response()->json(['message' => 'success fetching data', 'data' => $debtor->with('debts')->find($debtor->id), 'status' => 200], 200);
            } else {
                return response()->json(['message' => 'Debtor not found', 'data' => null], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debtor $debtor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debtor $debtor)
    {
        try {
            $debtor->update($request->all());
            return response()->json(
                [
                    'message' => 'success modified data',
                    'data' => $debtor,
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
    public function destroy(Debtor $debtor)
    {
        try {
            $debtor->delete();
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
