<?php

namespace App\Filament\Resources\ProvisionalBookingResource\Pages;

use App\Filament\Resources\ProvisionalBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProvisionalBooking extends EditRecord
{
    protected static string $resource = ProvisionalBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
