<?php

namespace Modules\Domain\Filament\Resources\PriceResource\Pages;

use Modules\Domain\Filament\Resources\PriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrices extends ListRecords
{
    protected static string $resource = PriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
