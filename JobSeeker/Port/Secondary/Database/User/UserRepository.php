<?php

namespace JobSeeker\Port\Secondary\Database\User;

use JobSeeker\Domain\JobSeekerManagement\User\Interfaces\UserRepositoryInterface;
use JobSeeker\Domain\JobSeekerManagement\User\Model\User;
use JobSeeker\Domain\JobSeekerManagement\User\Model\User as UserDomainModel;
use JobSeeker\Port\Secondary\Database\Base\EloquentBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JobSeeker\Port\Secondary\Database\User\User as ModelDao;

class UserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    public function __construct(ModelDao $model)
    {
        parent::__construct($model);
    }

    public function getAllUser(?string $search = "", int $perPage = 10, ?array $ids = null) : LengthAwarePaginator
    {
        $query = $this->createQuery();
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                return $query->where('id', $search)
                    ->orWhere('full_name', 'LIKE', '%' . $search . '%');
            });
        }

        return $query->paginate($perPage);
    }

    public function getUserById(int $id, ?array $relation = []): ?UserDomainModel
    {
        $query = $this->createQuery()->where('id', $id);
        if (!empty($relations)) {
            $query = $query->with($relations);
        }
        $modelDao = $query->first();

        return $modelDao ? $modelDao->toDomainEntity() : null;
    }


    public function save(User $user): User
    {
        return $this->createModelDAO($user->getId())->saveData($user);
    }

}