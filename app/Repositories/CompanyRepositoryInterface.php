<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CompanyRepositoryInterface
{
    /**
     * Get all user
     *
     * @param string|null $search
     * @param int         $perPage
     * @param array|null  $with
     *
     * @return LengthAwarePaginator
     */
    public function getAllCompany(?string $search = "", int $perPage = 10, ?array $with = null): LengthAwarePaginator;
}