<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Repositories\AdminRepositoryInterface;
use App\Repositories\Eloquent\EloquentBaseRepository;

class AdminRepository extends EloquentBaseRepository implements AdminRepositoryInterface
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
}