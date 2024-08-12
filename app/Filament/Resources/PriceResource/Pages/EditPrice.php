<?php

namespace Modules\Domain\Filament\Resources\PriceResource\Pages;

use Modules\Domain\Filament\Resources\PriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrice extends EditRecord
{
    protected static string $resource = PriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
