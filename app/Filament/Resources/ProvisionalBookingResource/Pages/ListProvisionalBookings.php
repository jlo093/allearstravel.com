<?php

namespace App\Filament\Resources\ProvisionalBookingResource\Pages;

use App\Filament\Resources\ProvisionalBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProvisionalBookings extends ListRecords
{
    protected static string $resource = ProvisionalBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
