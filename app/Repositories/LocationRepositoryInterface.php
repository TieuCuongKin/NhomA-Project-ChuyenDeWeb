<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LocationRepositoryInterface
{
    public function getAllLocation(?string $search = "", int $perPage = 10, ?array $ids = null): LengthAwarePaginator;

    public function loadLocation($param);
}