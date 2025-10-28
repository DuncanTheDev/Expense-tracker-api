<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $transactions = Transaction::where('user_id', $user)
            ->with('category')
            ->get();

        return response()->json([
            'message' => 'Transactions retrieve successfully',
            'data' => $transactions
        ], 200);
    }

    public function show($id)
    {
        $user = Auth::id();
        $transaction = Transaction::where('user_id', $user)
            ->where('id', $id)
            ->with('category')
            ->firstOrFail();

        return response()->json([
            'message' => "Transaction retrieved successfully",
            'data' => $transaction
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::id();
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'description' => 'required|string',
            'transaction_date' => 'required|date'
        ]);

        $transaction = Transaction::create([
            'user_id' => $user,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date
        ]);

        return response()->json([
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::id();
        $transaction = Transaction::where('user_id', $user)
            ->where('id', $id)
            ->firstOrFail($id);

        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categoies,id',
            'amount' => 'sometimes|decimal:10,2',
            'type' => 'sometimes|in:income,expense',
            'description' => 'nullable|string',
            'transaction_date' => 'sometimes|date'
        ]);

        $transaction->update($validated);

        return response()->json([
            'message',
            'Transaction updated successfully',
            'data' => $transaction,
        ], 200);
    }

    public function destroy($id)
    {
        $user = Auth::id();
        $transaction = Transaction::where('user_id', $user)
            ->where('id', $id)
            ->firstOrFail($id);

        $transaction->delete();

        return response()->json([
            'message',
            'Transaction deleted successfully',
        ], 200);
    }
}
