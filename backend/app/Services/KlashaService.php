<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KlashaService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.klasha.base_url', 'https://kdg-api.klasha.com/nucleus/');
        $this->apiKey = config('services.klasha.api_key');
    }

    /**
     * Initiate a Payout (e.g., to Alipay/WeChat).
     * 
     * @param array $data
     * @return array
     */
    public function payout(array $data)
    {
        // Mocking the response for development
        if (empty($this->apiKey)) {
            Log::info('Klasha Payout Mock:', $data);
            return [
                'status' => 'success',
                'message' => 'Payout initiated successfully (Mock)',
                'data' => [
                    'id' => 'k_ref_' . uniqid(),
                    'status' => 'pending'
                ]
            ];
        }

        try {
            // Example endpoint for Klasha payout
            $response = Http::withHeaders([
                'x-auth-token' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . 'payouts', [
                'currency' => $data['currency'], // 'CNY'
                'amount' => $data['amount'],
                'beneficiary' => [
                    'account_number' => $data['account_number'], // Alipay ID
                    'account_name' => $data['beneficiary_name'],
                    'bank_code' => 'alipay', // Or dynamic
                ],
                'narration' => $data['description'] ?? 'Payout',
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Klasha Payout Failed: ' . $response->body());
            throw new \Exception('Klasha Payout Failed: ' . $response->json()['message'] ?? 'Unknown error');

        } catch (\Exception $e) {
            Log::error('Klasha Service Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
