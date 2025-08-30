<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|string|max:255',
        ]);

        Transaction::create([
            'booking_id' => 1, // later you can dynamically pass booking id
            'user_id' => Auth::id(),
            'transaction_id' => $request->transaction_id,
        ]);

        // 🔹 Return JSON instead of redirect
        return response()->json([
            'success' => true,
            'message' => '✅ Thank you for your booking! Our admin will check availability and notify you soon.'
        ]);
    }

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'Transaction approved successfully!');
    }

    public function showForm()
    {
        // Return the blade file for entering transaction ID
        return view('transaction-info');
    }
}
