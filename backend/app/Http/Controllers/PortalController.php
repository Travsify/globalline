<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function dashboard()
    {
        return view('portal.dashboard');
    }

    public function settings()
    {
        $user = auth()->user();
        $verification = \App\Models\KycVerification::where('user_id', $user->id)->first();
        return view('portal.settings', compact('user', 'verification'));
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
        $user = auth()->user();
        $balances = \App\Models\WalletBalance::where('user_id', $user->id)->get()->pluck('amount', 'currency');
        
        // Ensure default balances exist
        foreach(['USD', 'CNY', 'NGN'] as $cur) {
            if(!isset($balances[$cur])) {
                \App\Models\WalletBalance::create(['user_id' => $user->id, 'currency' => $cur, 'amount' => 0]);
                $balances[$cur] = 0;
            }
        }

        $transactions = \App\Models\WalletTransaction::where('user_id', $user->id)->latest()->get();
        return view('portal.wallet', compact('balances', 'transactions', 'user'));
    }

    public function convertCurrency(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $user = auth()->user();
        $fromBalance = \App\Models\WalletBalance::where('user_id', $user->id)->where('currency', $request->from)->first();
        $toBalance = \App\Models\WalletBalance::where('user_id', $user->id)->where('currency', $request->to)->first();

        if ($fromBalance->amount < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient balance for conversion.');
        }

        // Mock Rates
        $rates = [
            'NGN_USD' => 1/1500,
            'USD_NGN' => 1500,
            'CNY_USD' => 1/7.2,
            'USD_CNY' => 7.2,
            'NGN_CNY' => 1/210,
            'CNY_NGN' => 210,
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

        return redirect()->back()->with('success', 'Currency conversion successful!');
    }

    public function addresses()
    {
        $addresses = \App\Models\Address::where('user_id', auth()->id())->latest()->get();
        return view('portal.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'label' => 'required|string',
            'recipient_name' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
        ]);

        \App\Models\Address::create([
            'user_id' => auth()->id() ?? 1,
            'label' => $request->label,
            'recipient_name' => $request->recipient_name,
            'street' => $request->street,
            'city' => $request->city,
            'country' => $request->country,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Address added to your book.');
    }

    public function notifications()
    {
        $notifications = \App\Models\Notification::where('user_id', auth()->id())->latest()->get();
        return view('portal.notifications', compact('notifications'));
    }

    public function tracking(Request $request)
    {
        $tracking_number = $request->tracking_number;
        $shipment = null;
        if($tracking_number) {
            $shipment = \App\Models\Shipment::where('tracking_number', $tracking_number)->first();
        }
        return view('portal.tracking', compact('shipment', 'tracking_number'));
    }

    public function consolidation()
    {
        $shipments = \App\Models\Shipment::where('user_id', auth()->id())->whereNull('consolidation_id')->get();
        $consolidations = \App\Models\ShipmentConsolidation::where('user_id', auth()->id())->latest()->get();
        return view('portal.consolidation', compact('shipments', 'consolidations'));
    }

    public function storeConsolidation(Request $request)
    {
        $request->validate([
            'shipment_ids' => 'required|array|min:2',
        ]);

        $consolidation = \App\Models\ShipmentConsolidation::create([
            'user_id' => auth()->id() ?? 1,
            'master_tracking_number' => 'MC' . strtoupper(substr(uniqid(), -8)),
            'status' => 'pending',
        ]);

        \App\Models\Shipment::whereIn('id', $request->shipment_ids)->update([
            'consolidation_id' => $consolidation->id
        ]);

        return redirect()->back()->with('success', 'Consolidation request submitted!');
    }

    public function storeSourcingRequest(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'description' => 'required|string',
        ]);

        \App\Models\SourcingRequest::create([
            'user_id' => auth()->id() ?? 1,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'status' => 'open',
        ]);

        return redirect()->back()->with('success', 'Sourcing request submitted to our China agents!');
    }

    public function kyc()
    {
        $verification = \App\Models\KycVerification::where('user_id', auth()->id())->first();
        return view('portal.kyc', compact('verification'));
    }

    public function storeKyc(Request $request)
    {
        $request->validate([
            'id_type' => 'required|string',
            'id_number' => 'required|string',
        ]);

        \App\Models\KycVerification::updateOrCreate(
            ['user_id' => auth()->id() ?? 1],
            [
                'id_type' => $request->id_type,
                'id_number' => $request->id_number,
                'status' => 'pending'
            ]
        );

        return redirect()->back()->with('success', 'KYC documents submitted for review.');
    }
}
