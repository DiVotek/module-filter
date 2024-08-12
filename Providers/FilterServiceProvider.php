<?php

namespace Modules\Filter\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Filter';

    public function boot(): void
    {
        $this->loadMigrations();
        $this->mergeConfigFrom(
            module_path('Filter', 'config/settings.php'),
            'settings'
        );
    }

    public function register(): void
    {
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Migrations'));
    }
}
