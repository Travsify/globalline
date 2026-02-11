<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function getBalance()
    {
        $user = Auth::user();
        return response()->json([
            'balance' => (float) $user->wallet_balance,
            'currency' => 'USD',
        ]);
    }

    public function fundWallet(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $user = Auth::user();
            $newBalance = $user->wallet_balance + $request->amount;

            $user->update(['wallet_balance' => $newBalance]);

            WalletTransaction::create([
                'user_id' => $user->id,
                'type' => 'credit',
                'amount' => $request->amount,
                'balance_after' => $newBalance,
                'description' => 'Wallet Funding',
                'status' => 'completed',
                'reference' => 'TXN-' . strtoupper(substr(uniqid(), -8)),
            ]);

            return response()->json([
                'message' => 'Wallet funded successfully',
                'balance' => $newBalance,
            ]);
        });
    }
}
