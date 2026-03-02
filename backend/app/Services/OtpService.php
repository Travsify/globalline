<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OtpService
{
    /**
     * Generate and store a 6-digit OTP for the given email.
     */
    public function generate(string $email): string
    {
        $otp = (string) rand(100000, 999999);
        
        // Store in password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        // Simulation: Log the OTP for testing/demo
        Log::info("GlobalLine Identity Verification: OTP for {$email} is {$otp}");
        
        return $otp;
    }

    /**
     * Verify if the provided OTP is valid and not expired (15 mins).
     */
    public function verify(string $email, string $otp): bool
    {
        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $otp)
            ->first();

        if (!$record) {
            return false;
        }

        // Check expiry (15 minutes)
        $createdAt = Carbon::parse($record->created_at);
        if ($createdAt->addMinutes(15)->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Clear the token after successful reset.
     */
    public function clear(string $email): void
    {
        DB::table('password_reset_tokens')->where('email', $email)->delete();
    }
}
