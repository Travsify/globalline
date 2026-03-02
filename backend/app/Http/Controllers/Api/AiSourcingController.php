<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AiSourcingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiSourcingController extends Controller
{
    protected $aiService;

    public function __construct(AiSourcingService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * POST /ai/sourcing/chat
     * Process a message from the Sourcing Assistant.
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        
        try {
            $result = $this->aiService->processQuery($request->message, $user->id);
            
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The sourcing node is currently busy. Please try again shortly.'
            ], 500);
        }
    }
}
