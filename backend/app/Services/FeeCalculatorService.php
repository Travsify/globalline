<?php

namespace App\Services;

use App\Models\FeeConfiguration;

class FeeCalculatorService
{
    protected CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Calculate a full fee breakdown for a transfer.
     *
     * @return array{
     *   send_amount: float,
     *   transfer_fee: float,
     *   fx_markup_amount: float,
     *   total_fees: float,
     *   amount_after_fees: float,
     *   exchange_rate: float,
     *   exchange_rate_display: string,
     *   receive_amount: float,
     *   send_currency: string,
     *   receive_currency: string,
     *   is_cross_currency: bool,
     *   corridor: string
     * }
     */
    public function calculate(string $from, string $to, float $amount): array
    {
        $from = strtoupper($from);
        $to = strtoupper($to);
        $isCrossCurrency = ($from !== $to);

        $feeConfig = FeeConfiguration::forCorridor($from, $to);

        if (!$feeConfig) {
            throw new \Exception("Currency corridor {$from} → {$to} is not available.");
        }

        // Validate amount limits
        if ($amount < (float) $feeConfig->min_amount) {
            throw new \Exception("Minimum transfer amount is {$feeConfig->min_amount} {$from}.");
        }
        if ($amount > (float) $feeConfig->max_amount) {
            throw new \Exception("Maximum transfer amount is {$feeConfig->max_amount} {$from}.");
        }

        // Calculate transfer fee
        $flatFee = (float) $feeConfig->transfer_fee_flat;
        $pctFee = $amount * (float) $feeConfig->transfer_fee_pct;
        $transferFee = round($flatFee + $pctFee, 2);

        $amountAfterFees = round($amount - $transferFee, 4);

        if ($isCrossCurrency) {
            // Get base rate and apply markup
            $baseRate = $this->currencyService->getRate($from, $to);
            $markupPct = (float) $feeConfig->fx_markup_pct;
            $adjustedRate = $baseRate * (1 + $markupPct);
            $fxMarkupAmount = round($amountAfterFees * $markupPct * $baseRate, 2);
            $receiveAmount = round($amountAfterFees * $adjustedRate, 2);

            return [
                'send_amount' => $amount,
                'transfer_fee' => $transferFee,
                'fx_markup_amount' => $fxMarkupAmount,
                'total_fees' => round($transferFee + ($fxMarkupAmount / $adjustedRate), 2),
                'amount_after_fees' => $amountAfterFees,
                'exchange_rate' => round($adjustedRate, 6),
                'exchange_rate_display' => "1 {$from} = " . number_format($adjustedRate, 2) . " {$to}",
                'receive_amount' => $receiveAmount,
                'send_currency' => $from,
                'receive_currency' => $to,
                'is_cross_currency' => true,
                'corridor' => "{$from}_{$to}",
            ];
        }

        // Same currency — no FX
        return [
            'send_amount' => $amount,
            'transfer_fee' => $transferFee,
            'fx_markup_amount' => 0,
            'total_fees' => $transferFee,
            'amount_after_fees' => $amountAfterFees,
            'exchange_rate' => 1.0,
            'exchange_rate_display' => "1 {$from} = 1 {$to}",
            'receive_amount' => $amountAfterFees,
            'send_currency' => $from,
            'receive_currency' => $to,
            'is_cross_currency' => false,
            'corridor' => 'SAME_CURRENCY',
        ];
    }
}
