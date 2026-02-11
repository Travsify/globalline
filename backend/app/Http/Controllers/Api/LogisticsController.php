<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogisticsController extends Controller
{
    public function getRates(Request $request)
    {
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'weight' => 'required|numeric',
        ]);

        // Mocking rates for now - for a production app, this would call a shipping provider API
        return response()->json([
            'rates' => [
                [
                    'service_name' => 'Economy Air',
                    'price' => round($request->weight * 12.5, 2),
                    'currency' => 'USD',
                    'estimated_days' => '5-7',
                ],
                [
                    'service_name' => 'Express Priority',
                    'price' => round($request->weight * 25.0, 2),
                    'currency' => 'USD',
                    'estimated_days' => '2-3',
                ],
                [
                    'service_name' => 'Logistics Plus',
                    'price' => round($request->weight * 8.0, 2),
                    'currency' => 'USD',
                    'estimated_days' => '10-14',
                ],
            ]
        ]);
    }

    public function createShipment(Request $request)
    {
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'weight' => 'required|numeric',
            'service_name' => 'required|string',
        ]);

        $price = round($request->weight * 15.0, 2); // Simplified pricing

        $shipment = Shipment::create([
            'user_id' => Auth::id(),
            'tracking_number' => Shipment::generateTrackingNumber(),
            'origin' => $request->origin,
            'origin_country' => $request->origin, // Simple mapping
            'destination' => $request->destination,
            'destination_country' => $request->destination,
            'status' => 'pending',
            'weight' => $request->weight,
            'price' => $price,
            'currency' => 'USD',
            'receiver_name' => 'Pending Info', // Would come from form in real app
        ]);

        return response()->json($shipment);
    }

    public function trackShipment($trackingNumber)
    {
        $shipment = Shipment::where('tracking_number', $trackingNumber)->firstOrFail();
        return response()->json($shipment);
    }
}
