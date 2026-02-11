<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GlobalMarketplaceController extends Controller
{
    /**
     * Display the public marketplace.
     */
    public function index(Request $request)
    {
        // Mock data representing aggregated response from Alibaba/1688/Taobao
        $products = $this->getMockProducts($request->query('node', 'all'), $request->query('query'));
        
        return view('marketplace', compact('products'));
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
            'price' => $request->price,
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
            'message' => 'Node synchronized with Collective.'
        ]);
    }

    /**
     * Mock product aggregator.
     */
    private function getMockProducts($node = 'all', $query = null)
    {
        $all = [
            ['id' => '101', 'name' => 'Industrial Hydraulic Press', 'price' => 12500, 'source' => '1688', 'img' => 'https://images.unsplash.com/photo-1581092583537-20d51b4b4f1b?auto=format&fit=crop&w=600&q=80', 'moq' => 1],
            ['id' => '102', 'name' => 'Precision Lathe G-Series', 'price' => 8400, 'source' => 'Alibaba', 'img' => 'https://images.unsplash.com/photo-1565152864273-5a02e5b74548?auto=format&fit=crop&w=600&q=80', 'moq' => 2],
            ['id' => '103', 'name' => 'Smart Control Unit X1', 'price' => 450, 'source' => 'Taobao', 'img' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=600&q=80', 'moq' => 5],
            ['id' => '104', 'name' => 'Carbon Fiber Frame Kit', 'price' => 2200, 'source' => '1688', 'img' => 'https://images.unsplash.com/photo-1558444452-92f7671f618a?auto=format&fit=crop&w=600&q=80', 'moq' => 10],
            ['id' => '105', 'name' => 'Solar Inverter 5KW', 'price' => 1100, 'source' => 'Alibaba', 'img' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80', 'moq' => 5],
            ['id' => '106', 'name' => 'LED Matrix Panel', 'price' => 45, 'source' => 'Taobao', 'img' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?auto=format&fit=crop&w=600&q=80', 'moq' => 50],
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
