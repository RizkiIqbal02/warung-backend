<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::with('product')->get();
        return response()
            ->json([
                'message' => 'success fetch all transaction',
                'count' => count($transaction),
                'data' => $transaction,
                'status' => 200
            ], 200);
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
                'quantity' => 'required',
                'amount' => 'required',
            ]);

            $transaction = Transaction::create($request->all());

            $today = date('Y-m-d');
            $income = Income::whereDate('created_at', $today)->first();

            if ($income) {
                // Jika income untuk hari ini sudah ada, tambahkan amount dari transaksi ke total income
                $income->total_amount += $transaction->amount;
                $income->save();
            } else {
                // Jika income untuk hari ini belum ada, buat income baru
                $income = Income::create([
                    'total' => $transaction->amount,
                    'created_at' => $today, // pastikan 'created_at' diisi dengan tanggal hari ini
                    'updated_at' => $today,
                ]);
            }

            return response()->json(['message' => 'success creating data', 'data' => $transaction, 'status' => 201], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        try {
            $transaction = Transaction::with('product')->find($transaction->id);
            if ($transaction) {
                return response()->json(['message' => 'success fetching data', 'data' => $transaction, 'status' => 200], 200);
            } else {
                return response()->json(['message' => 'trans$transaction not found', 'data' => null], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        try {
            $transaction->update($request->all());
            return response()->json(
                [
                    'message' => 'success modified data',
                    'data' => $transaction,
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
    public function destroy(Transaction $transaction)
    {
        try {
            $transaction->delete();
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
