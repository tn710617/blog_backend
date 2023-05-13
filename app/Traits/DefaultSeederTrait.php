<?php

namespace App\Traits;

use App\Helpers\ModelHelper;
use App\Interfaces\HasAfterSeeding;
use Illuminate\Support\Facades\Cache;

trait DefaultSeederTrait
{

    public function run()
    {
        app(ModelHelper::class)->upsertExcept($this->model, $this->definedData, $this->uniqueKey,
            $this->excludedColumns, $this->timestamps);

        foreach ($this->cacheKeys as $cacheKey) {
            Cache::forget($cacheKey);
        }

        if ($this instanceof HasAfterSeeding) {
            $this->afterRun();
        }
    }
}