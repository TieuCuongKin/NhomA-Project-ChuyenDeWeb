<?php

namespace App\Repositories\User;

use App\Enum\UserType;
use App\Models\User;
use App\Models\UserDetail;
use App\Repositories\Eloquent\EloquentBaseRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}