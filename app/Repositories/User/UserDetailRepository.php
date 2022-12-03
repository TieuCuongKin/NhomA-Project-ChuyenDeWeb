<?php

namespace App\Repositories\User;

use App\Models\UserDetail;
use App\Repositories\Eloquent\EloquentBaseRepository;
use App\Repositories\UserDetailRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserDetailRepository extends EloquentBaseRepository implements UserDetailRepositoryInterface
{
    public function __construct(UserDetail $model)
    {
        parent::__construct($model);
    }

    public function getAllUser(?string $search = "", int $perPage = 10, ?array $with = null) : LengthAwarePaginator
    {
        $query = $this->model->newModelQuery();
        if (!empty($with)) {
            $query->where(function ($query) use ($with) {
                return $query->with($with);
            });
        }

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                return $query->where('id', $search)
                    ->orWhere('full_name', 'LIKE', '%' . $search . '%');
            });
        }

        return $query->paginate($perPage);
    }
}