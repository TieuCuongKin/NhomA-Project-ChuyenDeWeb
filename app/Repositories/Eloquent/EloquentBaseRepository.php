<?php

namespace App\Repositories\Eloquent;

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
    public function findById($id, $relationship = [])
    {
        $query = $this->model->newModelQuery()->find($id);

        if ($relationship && !empty($query))
        {
            $query->with($relationship);
        }
        return $query;
    }

    //Add
    public function create(array $params)
    {
        return $this->model->newModelQuery()->create($params);
    }

    //Edit
    public function update($id, array $attributes): bool|int
    {
        return $this->findById($id)->update($attributes);
    }

    //Delete
    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}