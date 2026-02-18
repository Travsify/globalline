<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\LogisticsSetting;

class ClevverService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://api.clevver.io/v1'; // Standard Clevver API base
        $this->apiKey = LogisticsSetting::get('clevver_api_key');
    }

    protected function client()
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept' => 'application/json',
        ]);
    }

    public function getRegions()
    {
        // Mocking region fetch from Clevver - in live, this would hit /locations
        return [
            ['id' => 'us', 'name' => 'United States', 'activation_fee' => LogisticsSetting::get('activation_fee_us', 0)],
            ['id' => 'uk', 'name' => 'United Kingdom', 'activation_fee' => LogisticsSetting::get('activation_fee_uk', 0)],
            ['id' => 'de', 'name' => 'Germany', 'activation_fee' => LogisticsSetting::get('activation_fee_de', 0)],
            ['id' => 'cn', 'name' => 'China', 'activation_fee' => LogisticsSetting::get('activation_fee_cn', 0)],
        ];
    }

    public function requestAddress($userId, $regionId)
    {
        // Live integration would call: $this->client()->post("/spaces", [...]);
        // Returning mock success for now based on Clevver workflow
        $suiteSuffix = strtoupper(substr($regionId, 0, 2)) . '-' . (1000 + $userId);
        
        return [
            'success' => true,
            'suite_number' => 'GL-' . $suiteSuffix,
            'provider_id' => 'sp_' . uniqid(),
            'address' => "123 Manufacturing Way, Suite GL-$suiteSuffix, " . strtoupper($regionId)
        ];
    }

    public function getShippingQuote($packageId, $destination)
    {
        // Call Clevver API for quotes
        $baseRate = 45.00; // Mock base rate
        $markup = (float) LogisticsSetting::get('shipping_markup_percent', 20);
        
        $totalRate = $baseRate * (1 + ($markup / 100));
        
        return [
            'base_rate' => $baseRate,
            'markup' => $markup,
            'total_rate' => $totalRate,
            'currency' => 'USD'
        ];
    }
}
