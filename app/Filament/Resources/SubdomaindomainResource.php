<?php

namespace Modules\Domain\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Domain\Models\Subdomaindomain;

class SubdomaindomainResource extends BaseResource
{
    protected static ?string $model = Subdomaindomain::class;

    protected static ?string $slug = 'domain/subdomain/domain';

    protected static ?string $navigationGroup = 'Domain';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


}
