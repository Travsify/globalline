<?php

namespace App\Filament\Resources\KybReviewResource\Pages;

use App\Filament\Resources\KybReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKybReview extends EditRecord
{
    protected static string $resource = KybReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
