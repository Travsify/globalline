<?php

namespace App\Filament\Resources\ProcurementOrderResource\Pages;

use App\Filament\Resources\ProcurementOrderResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditProcurementOrder extends EditRecord
{
    protected static string $resource = ProcurementOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
