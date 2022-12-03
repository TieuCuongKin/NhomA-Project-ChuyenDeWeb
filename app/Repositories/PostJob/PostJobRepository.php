<?php

namespace App\Repositories\PostJob;

use App\Models\PostJob;
use App\Repositories\Eloquent\EloquentBaseRepository;
use App\Repositories\PostJobRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostJobRepository extends EloquentBaseRepository implements PostJobRepositoryInterface
{
    public function __construct(PostJob $model)
    {
        parent::__construct($model);
    }
    public function getAllJobs(?string $search = "", int $perPage = 10, ?array $with = null): LengthAwarePaginator
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
                    ->orWhere('job_title', 'LIKE', '%' . $search . '%')
                    ->orWhere('job_description', 'LIKE', '%' . $search . '%');

            });
        }

        return $query->paginate($perPage);
    }
}