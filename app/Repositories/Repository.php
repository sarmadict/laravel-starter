<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * The model connection to Database
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Get Model query builder instance
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->query();
    }

    /**
     * Set database model
     *
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get database model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get all Rows
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($columns = ['*'])
    {
        return $this->query()->get($columns);
    }

    /**
     * Wrap model findOrFail method
     *
     * @param $id
     *
     * @return Model|mixed
     */
    public function findOrFail($id)
    {
        return $this->query()->findOrFail($id);
    }

    /**
     * Wrap model find method
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }

    /**
     * Find item by a special column
     *
     * @param $field
     * @param $value
     * @param $columns
     *
     * @return Model|null|mixed
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->query()->where($field, $value)->first($columns);
    }

    /**
     * Create a new item
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->query()->create($data);
    }

    /**
     *
     *
     * @param $item
     * @param $data
     * @return mixed
     */
    public function update($item, $data)
    {
        return $item->update($data);
    }

    /**
     * Pass all unknown function through base model
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array(
            [$this->getModel(), $method],
            $args
        );
    }
}