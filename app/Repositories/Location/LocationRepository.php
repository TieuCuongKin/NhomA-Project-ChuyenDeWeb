<?php

namespace App\Repositories\Location;

use App\Models\Location;
use App\Repositories\Eloquent\EloquentBaseRepository;
use App\Repositories\LocationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LocationRepository extends EloquentBaseRepository implements LocationRepositoryInterface
{
    public function __construct(Location $model)
    {
        parent::__construct($model);
    }

    public function loadLocation($param)
    {
        $this->model->firstOrCreate($param);
    }

    public function getAllLocation(?string $search = "", int $perPage = 10, ?array $ids = null) : LengthAwarePaginator
    {
        $query = $this->model->newModelQuery();
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                return $query->where('id', $search)
                    ->orWhere('full_name', 'LIKE', '%' . $search . '%');
            });
        }

        return $query->paginate($perPage);
    }
}