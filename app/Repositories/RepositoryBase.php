<?php

namespace App\Repositories;

trait RepositoryBase
{
    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $instance = $this->model->findOrFail($id);
        $instance->update($data);

        return $instance;
    }

    public function delete($id)
    {
        $instance = $this->model->findOrFail($id);

        return $instance->delete();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get data
     *
     * @param  array  $params The query parameter array with field names as keys
     * @return mixed
     */
    public function getData($params = [], $with = [])
    {
        $model = $this->model;

        if (!isset($params['id'])) {
            $model = $model->orderBy('id', 'DESC');
        }

        foreach ($params as $field => $value) {
            if (is_array($value)) {
                $model = $model->whereIn($field, $value);
            } else {
                $model = $model->where($field, $value);
            }
        }

        return $model->with($with)->get();
    }
}
