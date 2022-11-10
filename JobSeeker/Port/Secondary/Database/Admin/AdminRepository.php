<?php

namespace JobSeeker\Port\Secondary\Database\Admin;

use JobSeeker\Domain\MasterManagement\Admin\Interfaces\AdminRepositoryInterface;
use JobSeeker\Port\Secondary\Database\Base\EloquentBaseRepository;

class AdminRepository extends EloquentBaseRepository implements AdminRepositoryInterface
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
}