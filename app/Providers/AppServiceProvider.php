<?php

namespace App\Providers;

use Illuminate\Support\Collection;
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
        Collection::macro('filterBlankable', function (array $blankableColumns = [], array $exceptColumns = []) {
            return $this->except($exceptColumns)->filter(function ($value, $column) use (
                $blankableColumns,
                $exceptColumns
            ) {
                if (in_array($column, $blankableColumns)) {
                    return true;
                }

                return filled($value);
            });
        });
    }
}
