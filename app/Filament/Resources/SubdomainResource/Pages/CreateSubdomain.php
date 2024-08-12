<?php

namespace Modules\Domain\Filament\Resources\SubdomainResource\Pages;

use Modules\Domain\Filament\Resources\SubdomainResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubdomain extends CreateRecord
{
    protected static string $resource = SubdomainResource::class;
}
