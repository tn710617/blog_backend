<?php

namespace App\Traits;

trait InputFilterable
{

    public function filterInput(array $input, array $blankableColumns = [], array $exceptColumns = [])
    {
        return collect($input)->except($exceptColumns)->filter(function ($value, $column) use (
            $blankableColumns,
            $exceptColumns
        ) {
            if (in_array($column, $blankableColumns)) {
                return true;
            }

            return filled($value);
        });
    }

}
