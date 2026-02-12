<?php

namespace App\Filament\Widgets;

use App\Models\KycVerification;
use App\Models\Shipment;
use App\Models\SupplierPayment;
use App\Models\SupportTicket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OpsQueueWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getHeading(): ?string
    {
        return 'Operations Queues';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('KYB Pending', KycVerification::where('status', 'pending')->count())
                ->description('Awaiting review')
                ->descriptionIcon('heroicon-m-identification')
                ->color('warning'),
            Stat::make('Payments Pending', SupplierPayment::where('status', 'pending')->count())
                ->description('Awaiting approval')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'),
            Stat::make('Shipments Active', Shipment::whereIn('status', ['pending', 'in_transit', 'customs'])->count())
                ->description('Requiring action')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info'),
            Stat::make('Open Tickets', SupportTicket::whereIn('status', ['open', 'in_progress'])->count())
                ->description('Unresolved issues')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('primary'),
        ];
    }
}
