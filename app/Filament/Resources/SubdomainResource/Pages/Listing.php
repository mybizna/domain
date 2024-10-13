<?php

namespace Modules\Domain\Filament\Resources\SubdomainResource\Pages;

use Modules\Base\Filament\Resources\Pages\ListingBase;
use Modules\Domain\Filament\Resources\SubdomainResource;

// Class List that extends ListBase
class Listing extends ListingBase
{
    protected static string $resource = SubdomainResource::class;
}
