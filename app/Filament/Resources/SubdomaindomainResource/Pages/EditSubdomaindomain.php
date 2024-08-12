<?php

namespace Modules\Domain\Filament\Resources\SubdomaindomainResource\Pages;

use Modules\Domain\Filament\Resources\SubdomaindomainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubdomaindomain extends EditRecord
{
    protected static string $resource = SubdomaindomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
