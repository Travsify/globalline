<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExternalMarketplaceService
{
    /**
     * Search for products across multiple platforms.
     * 
     * @param string $query
     * @param string $source (alibaba, 1688, taobao, or all)
     * @return array
     */
    public function search(string $query, string $source = 'all')
    {
        // specific logic for each platform would go here.
        // For now, we return high-fidelity mock data to simulate the integration.
        
        $results = [];
        
        if ($source === 'all' || $source === 'alibaba') {
            $results = array_merge($results, $this->mockAlibabaResults($query));
        }
        
        if ($source === 'all' || $source === '1688') {
             $results = array_merge($results, $this->mock1688Results($query));
        }

        return $results;
    }

    private function mockAlibabaResults(string $query)
    {
        return [
            [
                'id' => 'ext_' . uniqid(),
                'name' => "Global Direct: Bulk $query",
                'price' => rand(100, 5000),
                'currency' => 'USD',
                'image_url' => 'https://via.placeholder.com/150?text=Factory+Direct+' . urlencode($query),
                'source' => 'GlobalLine Direct', // Hide true source
                'moq' => 100,
                'rating' => 4.5,
                'supplier_name' => 'Premium Manufacturing Partner (Verified)', // Generic
                'description' => "High quality $query direct from our partner factory. Customizable logo and packaging available.",
            ],
            [
                'id' => 'ext_' . uniqid(),
                'name' => "Premium $query (Quick Sea Express)",
                'price' => rand(50, 2000),
                'currency' => 'USD',
                'image_url' => 'https://via.placeholder.com/150?text=Premium+Item',
                'source' => 'GlobalLine Direct',
                'moq' => 10,
                'rating' => 4.8,
                'supplier_name' => 'Global Tech Node #842',
                'description' => "Ready to ship $query. Fast delivery via GlobalLine logistics.",
            ]
        ];
    }

    private function mock1688Results(string $query)
    {
        return [
             [
                'id' => 'ext_' . uniqid(),
                'name' => "Factory Direct: $query",
                'price' => rand(10, 500), 
                'currency' => 'CNY',
                'image_url' => 'https://via.placeholder.com/150?text=Factory+' . urlencode($query),
                'source' => 'GlobalLine Direct',
                'moq' => 500,
                'rating' => 4.2,
                'supplier_name' => 'Verified Asian Manufacturer',
                'description' => "Domestic market version of $query. Best price for bulk orders.",
            ]
        ];
    }
}
