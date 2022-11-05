<?php

namespace JobSeeker\Domain\Admin\Repository;

use App\Repositories\EloquentBaseRepository;
use JobSeeker\Port\Secondary\Database\Base\Admin\Admin;
use JobSeeker\Port\Secondary\Database\Base\Admin\AdminRepositoryInterface;

class AdminRepository extends EloquentBaseRepository implements AdminRepositoryInterface
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
}