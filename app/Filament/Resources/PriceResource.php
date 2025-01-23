<?php

namespace Modules\Domain\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Domain\Models\Price;

class PriceResource extends BaseResource
{
    protected static ?string $model = Price::class;

    protected static ?string $slug = 'domain/price';

    protected static ?string $navigationGroup = 'Domain';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
