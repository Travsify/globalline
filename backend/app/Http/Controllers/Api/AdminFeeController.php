<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeeConfiguration;
use App\Models\PlatformAccount;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminFeeController extends Controller
{
    /**
     * GET /admin/fee-configurations — List all corridor fee configs.
     */
    public function index()
    {
        $this->authorizeAdmin();

        $configs = FeeConfiguration::all();

        return response()->json(['data' => $configs]);
    }

    /**
     * PUT /admin/fee-configurations/{id} — Update a corridor config.
     */
    public function update(Request $request, int $id)
    {
        $this->authorizeAdmin();

        $config = FeeConfiguration::findOrFail($id);

        $request->validate([
            'transfer_fee_flat' => 'nullable|numeric|min:0',
            'transfer_fee_pct' => 'nullable|numeric|min:0|max:1',
            'fx_markup_pct' => 'nullable|numeric|min:0|max:1',
            'min_amount' => 'nullable|numeric|min:0',
            'max_amount' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $config->update($request->only([
            'transfer_fee_flat', 'transfer_fee_pct', 'fx_markup_pct',
            'min_amount', 'max_amount', 'is_active',
        ]));

        return response()->json([
            'message' => "Corridor {$config->corridor} updated successfully.",
            'data' => $config->fresh(),
        ]);
    }

    /**
     * POST /admin/fee-configurations — Create a new corridor.
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'corridor' => 'required|string|unique:fee_configurations,corridor',
            'transfer_fee_flat' => 'nullable|numeric|min:0',
            'transfer_fee_pct' => 'nullable|numeric|min:0|max:1',
            'fx_markup_pct' => 'nullable|numeric|min:0|max:1',
            'min_amount' => 'nullable|numeric|min:0',
            'max_amount' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $config = FeeConfiguration::create($request->all());

        return response()->json([
            'message' => "Corridor {$config->corridor} created.",
            'data' => $config,
        ], 201);
    }

    /**
     * GET /admin/corridors — Overview of all corridors with live rates.
     */
    public function corridors(CurrencyService $currencyService)
    {
        $this->authorizeAdmin();

        $configs = FeeConfiguration::all();
        $corridors = [];

        foreach ($configs as $config) {
            $parts = explode('_', $config->corridor);
            $from = $parts[0] ?? null;
            $to = $parts[1] ?? null;

            $liveRate = null;
            if ($from && $to && $from !== 'SAME') {
                try {
                    $liveRate = $currencyService->getRate($from, $to);
                } catch (\Exception $e) {
                    $liveRate = null;
                }
            }

            $corridors[] = [
                'id' => $config->id,
                'corridor' => $config->corridor,
                'from' => $from,
                'to' => $to,
                'live_rate' => $liveRate,
                'fx_markup_pct' => (float) $config->fx_markup_pct,
                'transfer_fee_flat' => (float) $config->transfer_fee_flat,
                'transfer_fee_pct' => (float) $config->transfer_fee_pct,
                'min_amount' => (float) $config->min_amount,
                'max_amount' => (float) $config->max_amount,
                'is_active' => $config->is_active,
            ];
        }

        return response()->json(['data' => $corridors]);
    }

    /**
     * GET /admin/platform-accounts — View platform pool balances.
     */
    public function platformAccounts()
    {
        $this->authorizeAdmin();

        return response()->json([
            'data' => PlatformAccount::all(),
        ]);
    }

    /**
     * Ensure only super_admin or finance roles can access.
     */
    protected function authorizeAdmin(): void
    {
        $user = Auth::user();
        if (!$user || !$user->hasAnyAdminRole(['super_admin', 'finance', 'payments_ops'])) {
            abort(403, 'Unauthorized. Admin access required.');
        }
    }
}
