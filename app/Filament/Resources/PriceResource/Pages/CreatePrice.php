<?php

namespace Modules\Domain\Filament\Resources\PriceResource\Pages;

use Modules\Domain\Filament\Resources\PriceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrice extends CreateRecord
{
    protected static string $resource = PriceResource::class;
}
