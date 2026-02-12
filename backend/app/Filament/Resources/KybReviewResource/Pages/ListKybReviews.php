<?php

namespace App\Filament\Resources\KybReviewResource\Pages;

use App\Filament\Resources\KybReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKybReviews extends ListRecords
{
    protected static string $resource = KybReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
