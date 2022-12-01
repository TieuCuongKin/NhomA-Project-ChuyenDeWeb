<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * Get all user
     *
     * @param string|null $search
     * @param int         $perPage
     * @param array|null  $ids
     *
     * @return LengthAwarePaginator
     */
    public function getAllUser(?string $search = "", int $perPage = 10, ?array $ids = null): LengthAwarePaginator;
}