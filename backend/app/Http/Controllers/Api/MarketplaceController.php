<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    protected $pricingService;
    protected $currencyService;
    protected $externalService;

    public function __construct(
        \App\Services\PricingService $pricingService,
        \App\Services\CurrencyService $currencyService,
        \App\Services\ExternalMarketplaceService $externalService
    ) {
        $this->pricingService = $pricingService;
        $this->currencyService = $currencyService;
        $this->externalService = $externalService;
    }

    public function search(Request $request)
    {
        $selectedCurrency = $request->get('currency', 'USD');
        $source = $request->get('source', 'all'); // Default to all
        $queryStr = $request->get('query') ?? '';

        $products = collect([]);

        // 1. Fetch Local Products
        if ($source === 'all' || $source === 'local') {
            $localQuery = Product::where('is_active', true);
            if ($queryStr) {
                $localQuery->where(function($q) use ($queryStr) {
                    $q->where('name', 'like', "%{$queryStr}%")
                      ->orWhere('description', 'like', "%{$queryStr}%");
                });
            }
            if ($request->has('category')) {
                $localQuery->where('category', $request->query('category'));
            }
            
            $localProducts = $localQuery->latest()->take(20)->get()->map(function($product) use ($selectedCurrency) {
                 $baseUsd = $this->pricingService->applyMarkup((float)$product->price);
                 return [
                    'id' => $product->id,
                    'title' => $product->name,
                    'description' => $product->description,
                    'image_url' => $product->image_url,
                    'supplier_name' => 'GlobalLine Direct',
                    'moq' => '1 unit',
                    'images' => [$product->image_url],
                    'price' => (float)$product->price,
                    'base_usd_price' => $baseUsd,
                    'display_price' => $this->currencyService->convert($baseUsd, $selectedCurrency),
                    'symbol' => $this->currencyService->getSymbol($selectedCurrency),
                    'currency' => $selectedCurrency,
                    'category' => $product->category
                ];
            });
            $products = $products->merge($localProducts);
        }

        // 2. Fetch External Products
        if ($source === 'all' || $source !== 'local') {
             // If source is specific (e.g. 'alibaba'), use that, otherwise 'all' searches all external
             $externalSource = ($source === 'all') ? 'all' : $source;
             $externalProducts = $this->externalService->search($queryStr, $externalSource);
             $products = $products->merge($externalProducts);
        }
        
        // Shuffle for "Discovery" feel
        $products = $products->shuffle()->values();

        return response()->json([
            'products' => $products,
            'selected_currency' => $selectedCurrency,
            'available_currencies' => $this->currencyService->getAvailableCurrencies()
        ]);
    }

    public function show(Request $request, $id)
    {
        $selectedCurrency = $request->get('currency', 'USD');
        $product = Product::where('is_active', true)->findOrFail($id);
        
        $baseUsd = $this->pricingService->applyMarkup((float)$product->price);
        
        return response()->json([
            'id' => $product->id,
            'title' => $product->name,
            'description' => $product->description,
            'image_url' => $product->image_url,
            'supplier_name' => $product->origin_country ?? 'Global Node',
            'moq' => '1 unit',
            'images' => [$product->image_url],
            'price' => (float)$product->price,
            'base_usd_price' => $baseUsd,
            'display_price' => $this->currencyService->convert($baseUsd, $selectedCurrency),
            'symbol' => $this->currencyService->getSymbol($selectedCurrency),
            'currency' => $selectedCurrency,
            'category' => $product->category
        ]);
    }
}
