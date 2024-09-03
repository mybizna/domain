<?php

namespace Modules\Domain\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class DomainPlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Domain';
    }

    public function getId(): string
    {
        return 'domain';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
