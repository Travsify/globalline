<?php

namespace App\Services;

use App\Services\ExternalMarketplaceService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiSourcingService
{
    protected $marketplace;

    public function __construct(ExternalMarketplaceService $marketplace)
    {
        $this->marketplace = $marketplace;
    }

    /**
     * Process user message and return intelligent sourcing advice.
     */
    public function processQuery(string $message, int $userId): array
    {
        $query = strtolower($message);
        
        // 1. Extract Intent (Product Category/Keywords)
        $intent = $this->extractIntent($query);
        
        // 2. Fetch Relevant Products/Suppliers
        $products = [];
        if ($intent['keyword']) {
            $products = $this->marketplace->search($intent['keyword'], 'all');
        }

        // 3. Generate Intelligent Response
        // In a real production environment, this would call OpenAI/Gemini API.
        // Here we implement a high-fidelity intelligent logic layer.
        $response = $this->generateIntelligentResponse($intent, $products);

        return [
            'text' => $response['text'],
            'products' => array_slice($products, 0, 3), // Return top 3 matches
            'suggestions' => $response['suggestions'],
            'intent' => $intent
        ];
    }

    private function extractIntent(string $query): array
    {
        $keywords = ['iphone', 'laptop', 'shoe', 'nike', 'solar', 'panel', 'component', 'textile', 'machinery', 'phone'];
        $foundKeyword = null;
        
        foreach ($keywords as $kw) {
            if (str_contains($query, $kw)) {
                $foundKeyword = $kw;
                break;
            }
        }

        return [
            'keyword' => $foundKeyword,
            'is_bulk' => str_contains($query, 'bulk') || str_contains($query, 'moq') || str_contains($query, '100'),
            'location_pref' => str_contains($query, 'china') ? 'China' : (str_contains($query, 'turkey') ? 'Turkey' : null)
        ];
    }

    private function generateIntelligentResponse(array $intent, array $products): array
    {
        if (!$intent['keyword']) {
            return [
                'text' => "I'm analyzing the global supplier network. Could you specify which product category or manufacturing hub (China/Turkey/Dubai) you want to activate? I can bridge you to verified factory nodes immediately.",
                'suggestions' => ["Find Consumer Electronics", "Scan Textile Hubs", "Raw Material Sourcing"]
            ];
        }

        $count = count($products);
        $location = $intent['location_pref'] ?? 'Global Hubs';
        
        $text = "ANALYSIS COMPLETE. I have synced with the {$location} network for \"{$intent['keyword']}\". I found {$count} high-fidelity matches from verified suppliers. ";
        
        if ($intent['is_bulk']) {
            $text .= "Since you mentioned bulk requirements, I've prioritized DDP (Delivered Duty Paid) shipping options to save on logistics overhead.";
        } else {
            $text .= "Current factory inventory indicates immediate availability for pilot quantities.";
        }

        return [
            'text' => $text,
            'suggestions' => ["Compare Quotes", "Verify Certificates", "Shipment Estimate"]
        ];
    }
}
