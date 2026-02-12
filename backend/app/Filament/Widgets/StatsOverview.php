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
            Stat::make('Network Nodes', User::count())
                ->description('Active trade points')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),
            Stat::make('Global Traffic', Shipment::whereIn('status', ['pending', 'in_transit', 'picked_up'])->count())
                ->description('Shipments in flow')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->chart([15, 4, 17, 9, 21, 12, 25])
                ->color('warning'),
            Stat::make('Trade Volume', '$' . number_format(Shipment::sum('price') + Order::sum('total_amount'), 2))
                ->description('Aggregated revenue')
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->chart([10, 20, 15, 30, 25, 40, 35])
                ->color('success'),
            Stat::make('Pending Intelligence', Order::where('status', 'pending')->count())
                ->description('System orders')
                ->descriptionIcon('heroicon-m-bolt')
                ->chart([5, 12, 8, 15, 10, 18, 14])
                ->color('info'),
        ];
    }
}
