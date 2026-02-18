<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FincraService
{
    protected $baseUrl;
    protected $secretKey;

    public function __construct()
    {
        $this->baseUrl = config('services.fincra.base_url', 'https://api.fincra.com/');
        $this->secretKey = config('services.fincra.secret_key');
    }

    /**
     * Initiate a Payout to a Bank Account or Mobile Money.
     * 
     * @param array $data
     * @return array
     */
    public function payout(array $data)
    {
        // $data should include: 'amount', 'currency', 'beneficiary_name', 'account_number', 'bank_code', etc.
        
        // Mocking the response for development if keys are missing
        if (empty($this->secretKey)) {
            Log::info('Fincra Payout Mock:', $data);
            return [
                'status' => 'success',
                'message' => 'Payout initiated successfully (Mock)',
                'data' => [
                    'reference' => 'ref_' . uniqid(),
                    'status' => 'pending'
                ]
            ];
        }

        try {
            $response = Http::withHeaders([
                'api-key' => $this->secretKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . 'disbursements/payouts', [
                'sourceCurrency' => $data['sourceCurrency'] ?? 'NGN',
                'destinationCurrency' => $data['currency'],
                'amount' => $data['amount'],
                'business' => config('services.fincra.business_id'),
                'customerReference' => $data['reference'],
                'beneficiary' => [
                    'firstName' => $data['beneficiary_name'], // Simplification
                    'accountNumber' => $data['account_number'],
                    'bankCode' => $data['bank_code'] ?? null,
                    'type' => 'individual', // or corporate
                ],
                'description' => $data['description'] ?? 'Payout from GlobalLine',
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Fincra Payout Failed: ' . $response->body());
            throw new \Exception('Fincra Payout Failed: ' . $response->json()['message'] ?? 'Unknown error');

        } catch (\Exception $e) {
            Log::error('Fincra Service Error: ' . $e->getMessage());
            throw $e;
        }
    }
    
    public function getBanks()
    {
        // Implement get banks logic
    }
}
