<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\SupplierPayment;
use App\Models\WalletBalance;
use App\Models\WalletTransaction;
use App\Services\FincraService;
use App\Services\KlashaService;
use App\Services\LedgerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaySupplierController extends Controller
{
    protected $fincraService;
    protected $klashaService;
    protected $ledger;

    public function __construct(FincraService $fincraService, KlashaService $klashaService, LedgerService $ledger)
    {
        $this->fincraService = $fincraService;
        $this->klashaService = $klashaService;
        $this->ledger = $ledger;
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string|size:3', // Destination Currency (USD, CNY, NGN, GBP)
            'source_currency' => 'required|string|size:3', // Wallet to deduct from
            'beneficiary_name' => 'required|string',
            'account_number' => 'required|string', // Bank Account or Alipay ID
            'bank_code' => 'nullable|string', // For Bank Transfers
            'bank_name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();
        $amount = $request->amount;
        $sourceCurrency = $request->source_currency;
        $destCurrency = $request->currency;

        // 1. Check Balance in Source Wallet
        $balanceRecord = WalletBalance::where('user_id', $user->id)
            ->where('currency', $sourceCurrency)
            ->first();

        // Fallback for NGN/USD if using main wallet (legacy support logic, but assuming strict mostly)
        $currentBalance = 0;
        if ($balanceRecord) {
            $currentBalance = $balanceRecord->amount;
        } else if ($sourceCurrency === 'USD') {
             $currentBalance = $user->wallet_balance;
        }

        if ($currentBalance < $amount) {
            return response()->json(['message' => "Insufficient {$sourceCurrency} balance."], 400);
        }

        return DB::transaction(function () use ($request, $user, $amount, $sourceCurrency, $destCurrency) {
            // 2. Debit Source Wallet via Ledger
            $groupId = $this->ledger->payout(
                $user->id,
                $amount,
                $sourceCurrency,
                "Supplier Payment to {$request->beneficiary_name}",
                [
                    'beneficiary_name' => $request->beneficiary_name,
                    'account_number' => $request->account_number,
                    'bank_name' => $request->bank_name,
                    'currency' => $destCurrency,
                ]
            );

            // 4. Route to Payment Gateway
            $gatewayResponse = null;
            $gateway = '';

            try {
                $payload = $request->all();
                $payload['reference'] = 'REF-' . time(); // Generate unique ref

                // Routing Logic
                if ($destCurrency === 'CNY') {
                    // Route to China via Klasha
                    $gateway = 'Klasha';
                    $gatewayResponse = $this->klashaService->payout($payload);
                } else {
                    // Route Global/Local via Fincra
                    $gateway = 'Fincra';
                    // Ensure Fincra knows the source currency if we are doing conversion on their end
                    $payload['sourceCurrency'] = $sourceCurrency; 
                    $gatewayResponse = $this->fincraService->payout($payload);
                }

                $status = 'processing'; // Or 'successful' depending on provider sync response
                
            } catch (\Exception $e) {
                // Refund or Mark as Failed?
                // For now, we'll mark as failed but keep the deduction for manual review (safer) 
                // OR throw to rollback transaction.
                // Best practice: Rollback transaction if API call fails immediately.
                Log::error("Payout Error: " . $e->getMessage());
                throw $e; // This triggers DB rollback
            }

            // 5. Log the Supplier Payment Record (distinct from Wallet Transaction)
            $supplierPayment = SupplierPayment::create([
                'user_id' => $user->id,
                'supplier_name' => $request->beneficiary_name,
                'amount' => $amount,
                'currency' => $destCurrency,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name ?? $gateway,
                'status' => $status,
                'notes' => "Processed via {$gateway}. Ref: " . ($gatewayResponse['data']['reference'] ?? 'N/A'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Supplier payment initiated successfully.',
                'data' => $supplierPayment,
                'gateway_response' => $gatewayResponse
            ]);
        });
    }
}
