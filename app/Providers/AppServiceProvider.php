<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        Blade::directive('can', function ($permissions) {

            return "<?php if(auth('admin')->user()->can({$permissions})): ?>";
        });

        Blade::directive('endcan', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('canany', function ($permissions) {

            return "<?php if(auth('admin')->user()->canany({$permissions})): ?>";
        });

        Blade::directive('endcanany', function () {
            return '<?php endif; ?>';
        });
    }
}
