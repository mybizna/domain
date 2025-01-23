<?php

namespace Modules\Domain\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Domain\Models\Domain;

class DomainResource extends BaseResource
{
    protected static ?string $model = Domain::class;

    protected static ?string $slug = 'domain/domain';

    protected static ?string $navigationGroup = 'Domain';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
