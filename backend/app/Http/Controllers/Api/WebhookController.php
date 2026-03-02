<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserVirtualAccount;
use App\Services\LedgerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected LedgerService $ledger;

    public function __construct(LedgerService $ledger)
    {
        $this->ledger = $ledger;
    }

    /**
     * Handle Fincra Webhooks (Virtual Account Collections)
     */
    public function handleFincra(Request $request)
    {
        Log::info('Fincra Webhook:', $request->all());

        $signature = $request->header('fincra-signature');
        $webhookSecret = config('services.fincra.webhook_secret');

        // Optional: Implement signature verification here if secret exists
        
        $event = $request->input('event');
        $data = $request->input('data');

        if ($event === 'collection.successful' || $event === 'virtualaccount.collection.successful') {
            $accountNumber = $data['virtualAccount']['accountNumber'] ?? ($data['accountNumber'] ?? null);
            $amount = $data['amountIncoming'] ?? ($data['amount'] ?? 0);
            $currency = $data['currency'] ?? 'NGN';

            if ($accountNumber) {
                $account = UserVirtualAccount::where('account_number', $accountNumber)->first();
                if ($account) {
                    $this->ledger->fund($account->user_id, (float)$amount, $currency, 'Fincra Virtual Account');
                    return response()->json(['status' => 'success']);
                }
            }
        }

        return response()->json(['status' => 'event_ignored']);
    }

    /**
     * Handle Stripe Webhooks
     */
    public function handleStripe(Request $request)
    {
        Log::info('Stripe Webhook:', $request->all());
        
        $event = $request->input('type');
        $data = $request->input('data.object');

        if ($event === 'checkout.session.completed' || $event === 'payment_intent.succeeded') {
            $userId = $data['metadata']['user_id'] ?? ($data['client_reference_id'] ?? null);
            $amount = ($data['amount_received'] ?? $data['amount'] ?? 0) / 100; // Stripe uses cents
            $currency = strtoupper($data['currency'] ?? 'USD');

            if ($userId) {
                $this->ledger->fund((int)$userId, (float)$amount, $currency, 'Stripe Payment');
                return response()->json(['status' => 'success']);
            }
        }

        return response()->json(['status' => 'event_ignored']);
    }

    /**
     * Handle Paystack Webhooks
     */
    public function handlePaystack(Request $request)
    {
        Log::info('Paystack Webhook:', $request->all());

        // Verify signature
        $signature = $request->header('x-paystack-signature');
        $paystackSecret = config('services.paystack.secret_key');
        
        if ($signature !== hash_hmac('sha512', $request->getContent(), $paystackSecret)) {
            // Log::warning('Invalid Paystack signature');
            // return response()->json(['status' => 'invalid_signature'], 400);
        }

        $event = $request->input('event');
        $data = $request->input('data');

        if ($event === 'charge.success') {
            $userId = $data['metadata']['user_id'] ?? null;
            $amount = ($data['amount'] ?? 0) / 100; // Paystack uses kobo
            $currency = strtoupper($data['currency'] ?? 'NGN');

            if ($userId) {
                $this->ledger->fund((int)$userId, (float)$amount, $currency, 'Paystack Payment');
                return response()->json(['status' => 'success']);
            }
        }

        return response()->json(['status' => 'event_ignored']);
    }
}
