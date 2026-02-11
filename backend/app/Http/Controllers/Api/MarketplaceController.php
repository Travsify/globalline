<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function search(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->has('query')) {
            $query->where('name', 'like', '%' . $request->query('query') . '%');
        }

        if ($request->has('category')) {
            $query->where('category', $request->query('category'));
        }

        return response()->json([
            'products' => $query->latest()->get(),
        ]);
    }

    public function show($id)
    {
        $product = Product::where('is_active', true)->findOrFail($id);
        return response()->json($product);
    }
}
