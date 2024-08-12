<?php

namespace Modules\Domain\Filament\Resources\SubdomaindomainResource\Pages;

use Modules\Domain\Filament\Resources\SubdomaindomainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubdomaindomains extends ListRecords
{
    protected static string $resource = SubdomaindomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
