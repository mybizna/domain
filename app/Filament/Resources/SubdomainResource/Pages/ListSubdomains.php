<?php

namespace Modules\Domain\Filament\Resources\SubdomainResource\Pages;

use Modules\Domain\Filament\Resources\SubdomainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubdomains extends ListRecords
{
    protected static string $resource = SubdomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
