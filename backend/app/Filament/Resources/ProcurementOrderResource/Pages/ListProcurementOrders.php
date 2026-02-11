<?php

namespace App\Filament\Resources\ProcurementOrderResource\Pages;

use App\Filament\Resources\ProcurementOrderResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListProcurementOrders extends ListRecords
{
    protected static string $resource = ProcurementOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
