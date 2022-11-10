<?php

namespace JobSeeker\Domain\User\Repository;

use Illuminate\Support\Collection;
use JobSeeker\Port\Secondary\Database\Base\EloquentBaseRepository;
use JobSeeker\Port\Secondary\Database\User\User;
use JobSeeker\Port\Secondary\Database\User\UserRepositoryInterface;

class UserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}