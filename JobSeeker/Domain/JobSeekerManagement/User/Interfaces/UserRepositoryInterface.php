<?php

namespace JobSeeker\Domain\JobSeekerManagement\User\Interfaces;

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