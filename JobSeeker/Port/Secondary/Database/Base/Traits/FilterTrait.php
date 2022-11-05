<?php

namespace JobSeeker\Port\Secondary\Database\Base\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FilterTrait
{
    /**
     * Apply filter to the eloquent query builder
     *
     * @param Builder $query
     * @param array $filers
     * @return Builder
     */
    protected function applyFilers( Builder $query, array $filers) : Builder
    {
        foreach ($filers as $column => $value)
            $query = self::applyFilter($query, $column, $value);

        return $query;
    }

    /**
     * Apply each filter
     *
     * @param Builder $query
     * @param string $column
     * @param $value
     * @return Builder
     */
    protected static function applyFilter( Builder $query, string $column, $value) : Builder
    {
        if(is_array($value))
            return $query->whereBetween($column, $value);

        return  $query->where($column, $value);
    }
}
