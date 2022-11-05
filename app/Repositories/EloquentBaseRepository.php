<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class EloquentBaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    //Get all
    public function getAll($with = [])
    {
        return $this->model->newModelQuery()->with($with)->get();
    }

    //Find
    public function findById($id)
    {
        return $this->model->newModelQuery()->find($id);
    }

    //Add
    public function create(array $attributes)
    {
        return $this->model->newModelQuery()->create($attributes);
    }

    //Edit
    public function update($id, array $attributes)
    {
        return $this->findById($id)->update($attributes);
    }

    //Delete
    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}