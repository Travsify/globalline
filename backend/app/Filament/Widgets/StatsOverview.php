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
            Stat::make('Network Users', User::count())
                ->description('Active trade nodes')
                ->descriptionIcon('heroicon-m-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),
            Stat::make('Global Shipments', Shipment::whereIn('status', ['pending', 'in_transit', 'picked_up'])->count())
                ->description('Active logistics stream')
                ->descriptionIcon('heroicon-m-globe-americas')
                ->chart([15, 4, 17, 9, 21, 12, 25])
                ->color('warning'),
            Stat::make('Operational Revenue', '$' . number_format(Shipment::sum('price') + Order::sum('total_amount'), 2))
                ->description('Aggregated trade volume')
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart([10, 20, 15, 30, 25, 40, 35])
                ->color('success'),
            Stat::make('Market Intelligence', Order::where('status', 'pending')->count())
                ->description('Unsettled marketplace flow')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->chart([5, 12, 8, 15, 10, 18, 14])
                ->color('info'),
        ];
    }
}
