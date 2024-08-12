<?php

namespace Modules\Domain\Filament\Resources\RegistrarResource\Pages;

use Modules\Domain\Filament\Resources\RegistrarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegistrars extends ListRecords
{
    protected static string $resource = RegistrarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
