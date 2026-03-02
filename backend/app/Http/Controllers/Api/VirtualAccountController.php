<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserVirtualAccount;
use App\Services\FincraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VirtualAccountController extends Controller
{
    protected $fincra;

    public function __construct(FincraService $fincra)
    {
        $this->fincra = $fincra;
    }

    /**
     * Get the user's virtual account or create one if it doesn't exist.
     */
    public function getAccount(Request $request)
    {
        $user = Auth::user();
        $currency = $request->query('currency', 'NGN');

        $account = UserVirtualAccount::where('user_id', $user->id)
            ->where('currency', $currency)
            ->first();

        if (!$account) {
            try {
                $fincraData = $this->fincra->createVirtualAccount($user, $currency);
                
                if (isset($fincraData['data'])) {
                    $data = $fincraData['data'];
                    $account = UserVirtualAccount::create([
                        'user_id' => $user->id,
                        'account_number' => $data['account_number'],
                        'bank_name' => $data['bank_name'],
                        'account_name' => $data['account_name'],
                        'currency' => $data['currency'] ?? $currency,
                        'provider' => 'fincra',
                        'metadata' => $data,
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Could not generate virtual account at this time.'
                    ], 422);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $account
        ]);
    }
}
