<?php

namespace Modules\Domain\Filament\Resources\DomainResource\Pages;

use Modules\Base\Filament\Resources\Pages\ListingBase;
use Modules\Domain\Filament\Resources\DomainResource;

// Class List that extends ListBase
class Listing extends ListingBase
{
    protected static string $resource = DomainResource::class;
}
