<?php

namespace App\Repositories\Company;

use App\Enum\UserType;
use App\Models\Company;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CompanyRepository extends EloquentBaseRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function getAllCompany(?string $search = "", int $perPage = 10, ?array $with = null): LengthAwarePaginator
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
                    ->orWhere('company_name', 'LIKE', '%' . $search . '%');
            });
        }

        return $query->paginate($perPage);
    }

}