<?php

namespace JobSeeker\Port\Secondary\Database\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as CollectionDao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;

/*
 * Keep all the common repository declarations in Base Repository and extend it
 */

class EloquentBaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Model
     */
    protected Model $modelDAO;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        /*
         * @deprecated
         */
        $this->model = $model;
        $this->modelDAO = $model;
    }

    /**
     * @param null|int $id
     * @return Builder|Model
     */
    protected function createModelDAO(int $id = null)
    {
        return $id ?
            $this->createQuery()->where($this->modelDAO->getKeyName(), $id)->firstOrFail() :
            $this->modelDAO->newInstance();
    }

    /**
     * @return Builder
     */
    protected function createQuery(): Builder
    {
        return $this->modelDAO->newModelQuery();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->transformCollection($this->modelDAO->newModelQuery()->get());
    }

    /**
     * @param Collection $models
     *
     * @return bool
     */
    public function saveAll(Collection $models): bool
    {
        foreach ($models as $model) {
            $this->createModelDAO($model->getId())->saveData($model);
        }
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return $this->createQuery()->where($this->modelDAO->getKey(), $id)->delete();
    }

    /**
     * Create domain model collection from modelDao collection
     *
     * @param CollectionDao $modelDaoCollection
     * @return Collection
     */
    protected function transformCollection(CollectionDao $modelDaoCollection): Collection
    {
        $domainModelCollection = new Collection();

        /* @var BaseModel $item */
        foreach ($modelDaoCollection as $item) {
            try {
                $domainModelCollection->add($item->toDomainEntity());
            } catch (Throwable $e) {
                Log::error($e);
            }
        }

        return $domainModelCollection;
    }

    protected function transformArray(array $modelDaoArray): array
    {
        $domainModelArray = [];

        /* @var BaseModel $item */
        foreach ($modelDaoArray as $item) {
            $domainModelArray[] = $item->toDomainEntity();
        }

        return $domainModelArray;
    }

    /**
     * @return CollectionDao
     * @deprecated
     *
     */
    public function getAllModelDao(): CollectionDao
    {
        return $this->createQuery()->get();
    }

    /**
     * Get the initialized model
     *
     * @return BaseModel
     * @deprecated
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Paginate over the model
     *
     * @return LengthAwarePaginator
     * @deprecated
     */
    public function paginate(): LengthAwarePaginator
    {
        return $this->model->newModelQuery()->paginate();
    }

    /**
     * Find by Ids
     *
     * @param array $ids
     * @return Builder
     * @deprecated
     */
    public function findByIds(array $ids): Builder
    {
        return $this->model->newModelQuery()->whereIn('id', $ids);
    }

    /**
     * Get model data by key
     *
     * @param string $key
     * @return Builder
     * @deprecated
     */
    public function findByKey(string $key): Builder
    {
        return $this->model->newModelQuery()->where('key', $key);
    }

    /**
     * Create New data
     *
     * @param array $data
     * @return Model
     * @deprecated
     */
    public function create(array $data): Model
    {
        return $this->model->newModelQuery()->create($data);
    }

    /**
     * Update an existing data
     *
     * @param $value
     * @param array $data
     * @param string $column
     * @return bool
     * @deprecated
     */
    public function update($value, array $data, string $column = 'id'): bool
    {
        return $this->model->newModelQuery()->where($column, $value)->update($data);
    }

    /**
     * @param $value
     * @param string $column
     * @return bool
     * @throws \Exception
     * @deprecated
     *
     */
    public function deleteModelDao($value, string $column = 'id'): bool
    {
        return $this->createQuery()->where($column, $value)->delete();
    }

    public function deleteByIds(array $ids): bool
    {
        return $this->createQuery()->whereIn('id', $ids)->delete();
    }
}
