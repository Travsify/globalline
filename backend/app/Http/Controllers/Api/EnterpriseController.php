<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletBalance;
use App\Models\ShipmentConsolidation;
use App\Models\SourcingRequest;

class EnterpriseController extends Controller
{
    /**
     * Get Multi-currency Balances
     */
    public function wallets(Request $request)
    {
        $balances = WalletBalance::where('user_id', $request->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $balances
        ]);
    }

    /**
     * Convert Currency (Internal Swap)
     */
    public function convert(Request $request)
    {
        // Logic similar to PortalController but returns JSON
        return response()->json(['message' => 'Not implemented in stub'], 501);
    }

    /**
     * Get Consolidation Requests
     */
    public function consolidations(Request $request)
    {
        $consolidations = ShipmentConsolidation::where('user_id', $request->user()->id)
            ->with('shipments')
            ->latest()
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $consolidations
        ]);
    }

    /**
     * Submit Bespoke Sourcing Request
     */
    public function storeSourcingRequest(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'description' => 'required|string',
        ]);

        $sourcing = SourcingRequest::create([
            'user_id' => $request->user()->id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'status' => 'open',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Sourcing request submitted.',
            'data' => $sourcing
        ]);
    }
}
