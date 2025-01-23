<?php

namespace Modules\Domain\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Domain\Models\Registrar;

class RegistrarResource extends BaseResource
{
    protected static ?string $model = Registrar::class;

    protected static ?string $slug = 'domain/registrar';

    protected static ?string $navigationGroup = 'Domain';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
