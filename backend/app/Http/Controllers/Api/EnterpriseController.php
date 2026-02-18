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
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $user = $request->user();
        $fromBalance = WalletBalance::where('user_id', $user->id)->where('currency', $request->from)->first();
        $toBalance = WalletBalance::where('user_id', $user->id)->where('currency', $request->to)->first();

        if (!$fromBalance || $fromBalance->amount < $request->amount) {
            return response()->json(['message' => 'Insufficient balance or invalid currency.'], 422);
        }

        if (!$toBalance) {
             $toBalance = WalletBalance::create(['user_id' => $user->id, 'currency' => $request->to, 'amount' => 0]);
        }

        // Mock Rates (Sync with PortalController)
        $rates = [
            'NGN_USD' => 1/1500, 'USD_NGN' => 1500,
            'CNY_USD' => 1/7.2, 'USD_CNY' => 7.2,
            'NGN_CNY' => 1/210, 'CNY_NGN' => 210,
        ];

        $rateKey = $request->from . '_' . $request->to;
        $rate = $rates[$rateKey] ?? 1;
        $convertedAmount = $request->amount * $rate;

        $fromBalance->decrement('amount', $request->amount);
        $toBalance->increment('amount', $convertedAmount);

        \App\Models\WalletTransaction::create([
            'user_id' => $user->id,
            'amount' => -$request->amount,
            'currency' => $request->from,
            'type' => 'conversion',
            'status' => 'completed',
            'description' => "Converted {$request->amount} {$request->from} to {$convertedAmount} {$request->to}",
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Currency conversion successful!',
            'data' => [
                'from_balance' => $fromBalance->fresh()->amount,
                'to_balance' => $toBalance->fresh()->amount
            ]
        ]);
    }

    /**
     * Submit Consolidation Request
     */
    public function storeConsolidation(Request $request)
    {
        $request->validate([
            'shipment_ids' => 'required|array|min:2',
        ]);

        $consolidation = ShipmentConsolidation::create([
            'user_id' => $request->user()->id,
            'master_tracking_number' => 'MC' . strtoupper(substr(uniqid(), -8)),
            'status' => 'pending',
        ]);

        \App\Models\Shipment::whereIn('id', $request->shipment_ids)
            ->where('user_id', $request->user()->id)
            ->update(['consolidation_id' => $consolidation->id]);

        return response()->json([
            'status' => 'success',
            'message' => 'Consolidation request submitted!',
            'data' => $consolidation
        ]);
    }

    /**
     * Get Sourcing Orders
     */
    public function sourcingOrders(Request $request)
    {
        $orders = \App\Models\ProcurementOrder::where('user_id', $request->user()->id)->latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $orders
        ]);
    }

    /**
     * Submit Ship-for-Me Pre-advice
     */
    public function shipForMe(Request $request)
    {
        $request->validate([
            'external_tracking' => 'required|string',
            'item_name' => 'required|string',
            'quantity' => 'required|integer',
        ]);

        $shipment = \App\Models\Shipment::create([
            'user_id' => $request->user()->id,
            'tracking_number' => 'GL-PRE-' . strtoupper(substr(uniqid(), -6)),
            'status' => 'pre-advised',
            'origin' => 'Foreign Warehouse',
            'origin_country' => 'Intl',
            'destination' => 'Customer Managed',
            'destination_country' => 'NG',
            'weight' => 0,
            'price' => 0,
            'receiver_name' => $request->user()->name,
            'notes' => "External Tracking: {$request->external_tracking}\nItem: {$request->item_name}\nNotes: {$request->notes}",
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Package notification submitted!',
            'data' => $shipment
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
