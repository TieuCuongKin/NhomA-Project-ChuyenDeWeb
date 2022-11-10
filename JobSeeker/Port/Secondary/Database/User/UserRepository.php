<?php

namespace JobSeeker\Port\Secondary\Database\User;

use Illuminate\Support\Collection;
use JobSeeker\Domain\JobSeekerManagement\User\Interfaces\UserRepositoryInterface;
use JobSeeker\Port\Secondary\Database\Base\EloquentBaseRepository;
use JobSeeker\Port\Secondary\Database\User\User;

class UserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}