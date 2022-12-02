<?php

namespace App\Repositories\User;

use App\Models\UserDetail;
use App\Repositories\Eloquent\EloquentBaseRepository;
use App\Repositories\UserDetailRepositoryInterface;

class UserDetailRepository extends EloquentBaseRepository implements UserDetailRepositoryInterface
{
    public function __construct(UserDetail $model)
    {
        parent::__construct($model);
    }
}