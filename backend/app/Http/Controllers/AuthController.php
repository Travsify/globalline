<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $isJson = $request->wantsJson() || $request->is('api/*');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Stateless (API) Login
        if ($isJson) {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'The provided credentials are incorrect.'], 422);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user]);
        }

        // Stateful (Web) Login
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/portal/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function register(Request $request)
    {
        $isJson = $request->wantsJson() || $request->is('api/*');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'business_name' => 'nullable|string|max:255',
            'business_type' => 'nullable|string|in:importer,manufacturer,logistics,retailer',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        return DB::transaction(function () use ($request, $isJson) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'business_name' => $request->business_name,
                'business_type' => $request->business_type,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            // Stateless (API) Register
            if ($isJson) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json(['token' => $token, 'user' => $user]);
            }

            // Stateful (Web) Register
            Auth::login($user);
            return redirect('/portal/dashboard');
        });
    }

    public function logout(Request $request)
    {
        $isJson = $request->wantsJson() || $request->is('api/*');
        
        // Stateless (API) Logout
        if ($isJson && $request->user()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        }

        // Stateful (Web) Logout
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
