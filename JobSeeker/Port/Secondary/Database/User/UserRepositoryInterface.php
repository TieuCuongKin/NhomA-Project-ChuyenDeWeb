<?php

namespace JobSeeker\Port\Secondary\Database\User;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * Get all user
     *
     * @return Collection
     */
    public function getAll(): Collection;
}