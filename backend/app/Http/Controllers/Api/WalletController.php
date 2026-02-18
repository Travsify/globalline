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
            'currency' => 'nullable|string|in:USD,NGN,CNY', // Added currency validation
        ]);

        return DB::transaction(function () use ($request) {
            $user = Auth::user();
            $currency = $request->currency ?? 'USD';
            $amount = $request->amount;

            // 1. Update Specific Currency Balance (Enterprise Logic)
            // Check if we have a WalletBalance record for this currency
            $balanceRecord = \App\Models\WalletBalance::firstOrCreate(
                ['user_id' => $user->id, 'currency' => $currency],
                ['amount' => 0]
            );
            
            $balanceRecord->increment('amount', $amount);
            $newBalance = $balanceRecord->amount;

            // 2. Also update main wallet_balance if it's USD (for backward compatibility)
            if ($currency === 'USD') {
                $user->increment('wallet_balance', $amount);
            }

            WalletTransaction::create([
                'user_id' => $user->id,
                'type' => 'credit',
                'amount' => $amount,
                'balance_after' => $newBalance,
                'description' => "Wallet Funding ({$currency})",
                'status' => 'completed',
                'reference' => 'TXN-' . strtoupper(substr(uniqid(), -8)),
                // 'currency' => $currency, // Ensure your WalletTransaction model has this column or added it
            ]);

            return response()->json([
                'message' => 'Wallet funded successfully',
                'balance' => $newBalance,
                'currency' => $currency,
            ]);
        });
    }
}
