<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KycController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $verifications = $user->kycVerifications()->latest()->get();
        return response()->json($verifications);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'id_type' => 'required|string|in:national_id,passport,drivers_license',
            'id_number' => 'required|string|max:100',
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB limit
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $path = $request->file('document')->store('kyc-documents', 'public');
        $url = Storage::url($path);

        $verification = $user->kycVerifications()->create([
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'document_url' => $url,
            'status' => 'pending',
        ]);

        return response()->json($verification, 201);
    }

    public function status()
    {
        $latest = Auth::user()->kycVerifications()->latest()->first();
        return response()->json(['status' => $latest ? $latest->status : 'none']);
    }
}
