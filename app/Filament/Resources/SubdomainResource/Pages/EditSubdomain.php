<?php

namespace Modules\Domain\Filament\Resources\SubdomainResource\Pages;

use Modules\Domain\Filament\Resources\SubdomainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubdomain extends EditRecord
{
    protected static string $resource = SubdomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
