<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ModelHelper
{

    /**
     * upsert 預設會 update 所有 columns, 也可帶入指定要更新的欄位
     * 這個 helper 可帶入 $exceptColumns 指定複數欄位不更新
     * @return bool|int
     */
    public function upsertExcept(
        string $modelName,
        array $toBeUpdatedRows,
        array $uniqueColumns,
        array $exceptColumns,
        $timestamps = false
    ) {
        if (!$this->isModel($modelName)) {
            throw new \Exception('Invalid model name');
        }

        if (empty($toBeUpdatedRows)) {
            return false;
        }

        $toBeUpdatedColumns = array_keys(Arr::except($toBeUpdatedRows[0], $exceptColumns));

        /** @var Model $modelName */
        /** @var Builder $queryBuilder */
        $queryBuilder = $modelName::query();
        $queryBuilder = $timestamps ? $queryBuilder : $queryBuilder->toBase();

        return $queryBuilder->upsert($toBeUpdatedRows, $uniqueColumns, $toBeUpdatedColumns);
    }

    private function isModel(string $className): bool
    {
        if (!class_exists($className)) {
            return false;
        }

        $claimedModel = new $className;

        if (!($claimedModel) instanceof Model) {
            unset($claimedModel);

            return false;
        }

        unset($claimedModel);

        return true;
    }
}
