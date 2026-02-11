<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function dashboard()
    {
        return view('portal.dashboard');
    }

    public function shipments()
    {
        $shipments = \App\Models\Shipment::where('user_id', auth()->id())->latest()->get();
        return view('portal.shipments', compact('shipments')); 
    }

    public function shipForMe(Request $request)
    {
        $request->validate([
            'external_tracking' => 'required|string',
            'item_name' => 'required|string',
            'quantity' => 'required|integer',
        ]);

        // In a real app, we'd create a "ShipForMe" model or a Shipment with a special status
        \App\Models\Shipment::create([
            'user_id' => auth()->id() ?? 1, // Fallback for demo
            'tracking_number' => 'GL-PRE-' . strtoupper(substr(uniqid(), -6)),
            'status' => 'pre-advised',
            'origin' => 'China Warehouse',
            'origin_country' => 'China',
            'destination' => 'Customer Address',
            'destination_country' => 'Lagos, NG',
            'weight' => 0,
            'price' => 0,
            'receiver_name' => auth()->user()->name ?? 'Valued Customer',
            'notes' => "External Tracking: {$request->external_tracking}\nItem: {$request->item_name}\nNotes: {$request->notes}",
        ]);

        return redirect()->back()->with('success', 'Package notification submitted successfully!');
    }

    public function marketplace()
    {
        // Sample categories or search results could be passed here
        return view('portal.marketplace');
    }

    public function sourcing()
    {
        $orders = \App\Models\ProcurementOrder::where('user_id', auth()->id())->latest()->get();
        return view('portal.sourcing', compact('orders'));
    }

    public function payments()
    {
        $payments = \App\Models\SupplierPayment::where('user_id', auth()->id())->latest()->get();
        return view('portal.payments', compact('payments'));
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string',
            'amount' => 'required|numeric',
            'account_number' => 'required|string',
        ]);

        \App\Models\SupplierPayment::create([
            'user_id' => auth()->id() ?? 1,
            'supplier_name' => $request->supplier_name,
            'amount' => $request->amount,
            'account_number' => $request->account_number,
            'swift_code' => $request->swift_code,
            'invoice_url' => $request->invoice_url,
            'status' => 'pending',
            'currency' => 'USD',
            'local_amount' => $request->amount * 1500, // Example rate
        ]);

        return redirect()->back()->with('success', 'Supplier payment initiated successfully!');
    }

    public function wallet()
    {
        $transactions = \App\Models\WalletTransaction::where('user_id', auth()->id())->latest()->get();
        $user = auth()->user();
        return view('portal.wallet', compact('transactions', 'user'));
    }
}
