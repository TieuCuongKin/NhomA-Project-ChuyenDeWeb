<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Eloquent\EloquentBaseRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllUser(?string $search = "", int $perPage = 10, ?array $with = null) : LengthAwarePaginator
    {
        $query = $this->model->newModelQuery()->with($with);
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