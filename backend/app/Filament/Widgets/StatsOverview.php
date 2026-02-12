<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Shipment;
use App\Models\SupplierPayment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $todayOrders = Order::whereDate('created_at', today())->count();
        $todayPayments = SupplierPayment::whereDate('created_at', today())->count();
        $activeCustomers = User::where('role', 'user')->where('is_active', true)->count();
        $totalShipments = Shipment::count();
        $deliveredShipments = Shipment::where('status', 'delivered')->count();
        $successRate = $totalShipments > 0 ? round(($deliveredShipments / $totalShipments) * 100, 1) : 0;
        $todayVolume = Shipment::whereDate('created_at', today())->sum('price') + Order::whereDate('created_at', today())->sum('total_amount');

        return [
            Stat::make('Daily Volume', $todayOrders + $todayPayments)
                ->description('Orders + Payments today')
                ->descriptionIcon('heroicon-m-bolt')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),
            Stat::make('Active Customers', $activeCustomers)
                ->description('Registered businesses')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([15, 18, 20, 22, 25, 27, 30])
                ->color('success'),
            Stat::make('Success Rate', $successRate . '%')
                ->description('Shipment delivery rate')
                ->descriptionIcon('heroicon-m-check-badge')
                ->chart([85, 88, 87, 90, 92, 89, $successRate])
                ->color($successRate >= 85 ? 'success' : 'warning'),
            Stat::make('Today\'s Revenue', '$' . number_format($todayVolume, 2))
                ->description('Trade volume today')
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->chart([10, 20, 15, 30, 25, 40, 35])
                ->color('info'),
        ];
    }
}
