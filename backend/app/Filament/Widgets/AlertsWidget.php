<?php

namespace App\Filament\Widgets;

use App\Models\Shipment;
use App\Models\SupplierPayment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AlertsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected function getHeading(): ?string
    {
        return 'System Alerts';
    }

    protected function getStats(): array
    {
        $failedPayments = SupplierPayment::where('status', 'failed')->count();
        $delayedShipments = Shipment::where('status', 'in_transit')
            ->where('updated_at', '<', now()->subDays(7))
            ->count();

        return [
            Stat::make('Payout Failures', $failedPayments)
                ->description($failedPayments > 0 ? 'Requires immediate action' : 'All clear')
                ->descriptionIcon($failedPayments > 0 ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-check-circle')
                ->color($failedPayments > 0 ? 'danger' : 'success'),
            Stat::make('Delivery Delays', $delayedShipments)
                ->description('Shipments > 7 days in transit')
                ->descriptionIcon($delayedShipments > 0 ? 'heroicon-m-clock' : 'heroicon-m-check-circle')
                ->color($delayedShipments > 0 ? 'warning' : 'success'),
        ];
    }
}
