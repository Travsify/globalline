<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GlobalMarketplaceController extends Controller
{
    protected $pricingService;
    protected $currencyService;

    public function __construct(\App\Services\PricingService $pricingService, \App\Services\CurrencyService $currencyService)
    {
        $this->pricingService = $pricingService;
        $this->currencyService = $currencyService;
    }

    /**
     * Display the public marketplace.
     */
    public function index(Request $request)
    {
        $selectedCurrency = $request->get('currency', Session::get('currency', 'USD'));
        Session::put('currency', $selectedCurrency);

        // Mock data representing aggregated response from Alibaba/1688/Taobao
        $products = $this->getMockProducts($request->query('node', 'all'), $request->query('query'));
        
        // Apply pricing logic and currency conversion
        foreach ($products as &$product) {
            $product['base_usd_price'] = $this->pricingService->applyMarkup($product['price']);
            $product['display_price'] = $this->currencyService->convert($product['base_usd_price'], $selectedCurrency);
            $product['symbol'] = $this->currencyService->getSymbol($selectedCurrency);
        }

        $availableCurrencies = $this->currencyService->getAvailableCurrencies();

        return view('marketplace', compact('products', 'selectedCurrency', 'availableCurrencies'));
    }

    /**
     * Search products via external node APIs.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $node = $request->input('node', 'all');
        
        return redirect()->route('marketplace.index', ['query' => $query, 'node' => $node]);
    }

    /**
     * Add item to the guest/member collective (cart).
     */
    public function addToCollective(Request $request)
    {
        $cart = Session::get('collective_cart', []);
        
        $item = [
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price, // Raw base
            'display_price' => $request->display_price, // Marked up + Converted
            'symbol' => $request->symbol,
            'source' => $request->source,
            'img' => $request->img,
            'qty' => $request->qty ?? 1
        ];

        // Unique ID based on source and product ID
        $cartId = $item['source'] . '_' . $item['id'];
        
        if (isset($cart[$cartId])) {
            $cart[$cartId]['qty'] += $item['qty'];
        } else {
            $cart[$cartId] = $item;
        }

        Session::put('collective_cart', $cart);

        return response()->json([
            'success' => true,
            'count' => count($cart),
            'currency' => Session::get('currency', 'USD'),
            'message' => 'Node synchronized with Collective.'
        ]);
    }

    /**
     * Mock product aggregator.
     */
    private function getMockProducts($node = 'all', $query = null)
    {
        $all = [
            ['id' => '101', 'name' => 'Industrial Hydraulic Press', 'price' => 12500, 'source' => 'Factory Direct (CN)', 'img' => 'https://images.unsplash.com/photo-1581092583537-20d51b4b4f1b?auto=format&fit=crop&w=600&q=80', 'moq' => 1],
            ['id' => '102', 'name' => 'Precision Lathe G-Series', 'price' => 8400, 'source' => 'Premium Tech (US)', 'img' => 'https://images.unsplash.com/photo-1565152864273-5a02e5b74548?auto=format&fit=crop&w=600&q=80', 'moq' => 2],
            ['id' => '103', 'name' => 'Smart Control Unit X1', 'price' => 450, 'source' => 'Eco-Friendly Hub (EU)', 'img' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=600&q=80', 'moq' => 5],
            ['id' => '104', 'name' => 'Carbon Fiber Frame Kit', 'price' => 2200, 'source' => 'Factory Direct (CN)', 'img' => 'https://images.unsplash.com/photo-1558444452-92f7671f618a?auto=format&fit=crop&w=600&q=80', 'moq' => 10],
            ['id' => '105', 'name' => 'Solar Inverter 5KW', 'price' => 1100, 'source' => 'Premium Tech (US)', 'img' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80', 'moq' => 5],
            ['id' => '106', 'name' => 'LED Matrix Panel', 'price' => 45, 'source' => 'Eco-Friendly Hub (EU)', 'img' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?auto=format&fit=crop&w=600&q=80', 'moq' => 50],
        ];

        if ($node !== 'all') {
            $all = array_values(array_filter($all, fn($p) => strtolower($p['source']) === strtolower($node)));
        }

        if ($query) {
            $all = array_values(array_filter($all, fn($p) => str_contains(strtolower($p['name']), strtolower($query))));
        }

        return $all;
    }
}
