<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierPaymentController extends Controller
{
    public function index()
    {
        $payments = SupplierPayment::where('user_id', Auth::id())
            ->latest()
            ->paginate(15);
            
        return response()->json($payments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string',
            'amount' => 'required|numeric',
            'currency' => 'required|string|size:3',
            'account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'swift_code' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $localAmount = 0;
        // Simple mock conversion for demo purposes
        if ($request->currency === 'USD') {
            $localAmount = $request->amount * 1500; // NGN
        } else if ($request->currency === 'CNY') {
            $localAmount = $request->amount * 210; // NGN
        } else {
             $localAmount = $request->amount;
        }

        $payment = SupplierPayment::create([
            'user_id' => Auth::id(),
            'supplier_name' => $request->supplier_name,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'swift_code' => $request->swift_code,
            'notes' => $request->notes,
            'status' => 'pending',
            'local_amount' => $localAmount,
            'local_currency' => 'NGN', 
        ]);

        return response()->json([
            'message' => 'Payment logged successfully',
            'payment' => $payment
        ], 201);
    }
}
