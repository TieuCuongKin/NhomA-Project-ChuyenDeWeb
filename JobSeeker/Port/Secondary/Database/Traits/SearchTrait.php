<?php

namespace JobSeeker\Port\Secondary\Database\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchTrait
{
    /**
     * Apply search to the eloquent query builder
     *
     * @param Builder $query
     * @param string $search
     * @return Builder
     */
    protected function applySearch( Builder $query, string $search) : Builder
    {
        $searches = $this->getSortedSearch(preg_split ("/[\s,]+/", $search));

        foreach ($searches as $column => $search)
            empty($search) ?: $query = self::applySearchQueryOnModel ($query, $column, $search);

        return $query;
    }

    /**
     * Apply search query
     *
     * @param Builder $query
     * @param string $column
     * @param $searches
     * @return mixed
     */
    protected static function applySearchQueryOnModel(Builder $query, string $column, $searches) : Builder
    {
        if($column == 'name')
            foreach ( $searches as $search )
                $query = $query->orWhere($query->getModel()->qualifyColumn($column) , 'like' , '%' . $search . '%');
        else
            $query = $query->orWhereIn($query->getModel()->qualifyColumn($column), $searches);

        return $query;
    }

    /**
     * Sort based on preg match
     *
     * @param array $finalSearchKeys
     * @param string $searchKey
     * @return array
     */
    protected static function sortSearchKeys(array $finalSearchKeys, string $searchKey) : array
    {
        if (preg_match('/([0-9]+)/',$searchKey))

            $finalSearchKeys['id'][] = (int)$searchKey;

        else

            $finalSearchKeys['name'][] = $searchKey;

        return $finalSearchKeys;
    }
}
