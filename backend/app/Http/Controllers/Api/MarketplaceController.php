<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    protected $pricingService;
    protected $currencyService;

    public function __construct(
        \App\Services\PricingService $pricingService,
        \App\Services\CurrencyService $currencyService
    ) {
        $this->pricingService = $pricingService;
        $this->currencyService = $currencyService;
    }

    public function search(Request $request)
    {
        $selectedCurrency = $request->get('currency', 'USD');
        
        $query = Product::where('is_active', true);

        if ($request->has('query')) {
            $query->where('name', 'like', '%' . $request->query('query') . '%');
        }

        if ($request->has('category')) {
            $query->where('category', $request->query('category'));
        }

        $products = $query->latest()->get()->map(function($product) use ($selectedCurrency) {
            $baseUsd = $this->pricingService->applyMarkup((float)$product->price);
            return [
                'id' => $product->id,
                'title' => $product->name,
                'description' => $product->description,
                'image_url' => $product->image_url,
                'supplier_name' => $product->origin_country ?? 'Global Node',
                'moq' => '1 unit',
                'images' => [$product->image_url],
                'price' => (float)$product->price, // Raw base
                'base_usd_price' => $baseUsd,
                'display_price' => $this->currencyService->convert($baseUsd, $selectedCurrency),
                'symbol' => $this->currencyService->getSymbol($selectedCurrency),
                'currency' => $selectedCurrency,
                'category' => $product->category
            ];
        });

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
