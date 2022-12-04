<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostJobRepositoryInterface
{
    /**
     * Get all company
     *
     * @param string|null $search
     * @param int         $perPage
     * @param array|null  $with
     *
     * @return LengthAwarePaginator
     */
    public function getAllJobs(?string $search = "", int $perPage = 10, ?array $with = null): LengthAwarePaginator;
}