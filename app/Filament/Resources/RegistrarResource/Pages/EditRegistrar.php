<?php

namespace Modules\Domain\Filament\Resources\RegistrarResource\Pages;

use Modules\Domain\Filament\Resources\RegistrarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistrar extends EditRecord
{
    protected static string $resource = RegistrarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
