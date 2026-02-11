<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Shipment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Active customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            Stat::make('Active Shipments', Shipment::whereIn('status', ['pending', 'in_transit', 'picked_up'])->count())
                ->description('Logistics in progress')
                ->descriptionIcon('heroicon-m-truck')
                ->color('warning'),
            Stat::make('Total Revenue', '$' . number_format(Shipment::sum('price') + Order::sum('total_amount'), 2))
                ->description('Gross earnings')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->description('Marketplace orders')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),
        ];
    }
}
