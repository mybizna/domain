<?php

namespace Modules\Domain\Filament\Resources\DomainResource\Pages;

use Modules\Domain\Filament\Resources\DomainResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDomain extends CreateRecord
{
    protected static string $resource = DomainResource::class;
}
