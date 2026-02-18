<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'business_name' => 'nullable|string|max:255',
            'business_type' => 'nullable|string|in:importer,manufacturer,logistics,retailer',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
        ]);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password does not match'], 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['message' => 'Password changed successfully']);
    }
}
