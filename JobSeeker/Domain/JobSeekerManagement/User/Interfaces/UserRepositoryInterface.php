<?php

namespace JobSeeker\Domain\JobSeekerManagement\User\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use JobSeeker\Domain\JobSeekerManagement\User\Model\User;

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

    /**
     * @param int        $id
     * @param array|null $relation
     * @return User|null
     */
    public function getUserById(int $id, ?array $relation = []) : ?User;

    /**
     * Create new user
     *
     * @param User $user
     * @return User
     */
    public function save(User $user): User;
}