<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyController extends Controller
{
    public function getStats()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $tiermap = [
            'bronze' => ['min' => 0, 'max' => 500, 'next' => 'silver'],
            'silver' => ['min' => 501, 'max' => 2000, 'next' => 'gold'],
            'gold' => ['min' => 2001, 'max' => 10000, 'next' => 'diamond'],
            'diamond' => ['min' => 10001, 'max' => null, 'next' => null],
        ];

        $currentTier = $user->tier ?? 'bronze';
        $stats = $tiermap[$currentTier];

        return response()->json([
            'points' => $user->loyalty_points,
            'tier' => $currentTier,
            'next_tier' => $stats['next'],
            'progress_to_next' => $stats['max'] ? ($user->loyalty_points - $stats['min']) / ($stats['max'] - $stats['min']) : 1,
            'points_needed' => $stats['max'] ? max(0, $stats['max'] - $user->loyalty_points) : 0,
        ]);
    }
}
