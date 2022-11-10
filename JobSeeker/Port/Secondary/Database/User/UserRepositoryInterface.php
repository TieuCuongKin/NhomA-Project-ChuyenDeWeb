<?php

namespace JobSeeker\Port\Secondary\Database\User;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * Get all groups
     *
     * @return Collection
     */
    public function getAll(): Collection;
}