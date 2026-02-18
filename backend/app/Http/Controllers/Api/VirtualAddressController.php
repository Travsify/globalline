<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VirtualAddress;
use App\Models\LogisticsSetting;
use App\Services\ClevverService;
use Illuminate\Support\Facades\Auth;

class VirtualAddressController extends Controller
{
    protected $clevver;

    public function __construct(ClevverService $clevver)
    {
        $this->clevver = $clevver;
    }

    public function getRegions()
    {
        return response()->json($this->clevver->getRegions());
    }

    public function myAddresses()
    {
        $addresses = VirtualAddress::where('user_id', Auth::id())->get();
        return response()->json($addresses);
    }

    public function requestAddress(Request $request)
    {
        $request->validate([
            'region' => 'required|string'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Check if user already has an address for this region
        $existing = VirtualAddress::where('user_id', $user->id)
                                  ->where('region', $request->region)
                                  ->first();
        
        if ($existing) {
            return response()->json(['message' => 'You already have an address in this region'], 400);
        }

        // Check for activation fee (Pay-as-you-go)
        $fee = (float) LogisticsSetting::get('activation_fee_' . $request->region, 0);
        if ($fee > 0) {
            if ($user->wallet_balance < $fee) {
                return response()->json(['message' => "Insufficient wallet balance for $request->region activation fee ($$fee)"], 400);
            }
            $user->decrement('wallet_balance', $fee);
        }

        $result = $this->clevver->requestAddress($user->id, $request->region);

        if ($result['success']) {
            $address = VirtualAddress::create([
                'user_id' => $user->id,
                'suite_number' => $result['suite_number'],
                'region' => $request->region,
                'provider_id' => $result['provider_id'],
                'status' => 'active'
            ]);

            return response()->json([
                'message' => 'Virtual address assigned successfully',
                'address' => $address,
                'full_address' => $result['address']
            ]);
        }

        return response()->json(['message' => 'Failed to assign virtual address'], 500);
    }
}
