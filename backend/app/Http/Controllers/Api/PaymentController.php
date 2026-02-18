<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function initialize(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'gateway' => 'required|in:stripe,paystack',
            'email' => 'required|email',
        ]);

        $gateway = $request->gateway;
        $amount = $request->amount;
        $currency = $request->currency;
        $email = $request->email;

        if ($gateway === 'stripe') {
            return $this->initializeStripe($amount, $currency);
        } elseif ($gateway === 'paystack') {
            return $this->initializePaystack($amount, $email);
        }

        return response()->json(['error' => 'Invalid gateway'], 400);
    }

    private function initializeStripe($amount, $currency)
    {
        // In a real app, use Stripe SDK to create PaymentIntent
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // $intent = \Stripe\PaymentIntent::create([...]);
        
        // Mocking Client Secret for demo purposes
        // Real client secret looks like: pi_1Gs..._secret_...
        return response()->json([
            'client_secret' => 'pi_mock_' . Str::random(24) . '_secret_' . Str::random(24),
            'publishable_key' => env('STRIPE_KEY', 'pk_test_mock'),
            'gateway' => 'stripe'
        ]);
    }

    private function initializePaystack($amount, $email)
    {
        // In a real app, call Paystack API
        // Http::withToken(env('PAYSTACK_SECRET'))->post(...)
        
        // Mocking Access Code
        return response()->json([
            'access_code' => 'access_' . Str::random(10),
            'reference' => 'ref_' . Str::random(10),
            'authorization_url' => 'https://checkout.paystack.com/mock_' . Str::random(10),
            'public_key' => env('PAYSTACK_PUBLIC_KEY', 'pk_test_mock'),
            'gateway' => 'paystack'
        ]);
    }
    
    public function verify(Request $request)
    {
         $request->validate([
            'reference' => 'required|string',
            'gateway' => 'required|in:stripe,paystack',
        ]);
        
        // Mock verification success
        return response()->json([
            'status' => 'success',
            'message' => 'Payment verified successfully'
        ]);
    }
}
