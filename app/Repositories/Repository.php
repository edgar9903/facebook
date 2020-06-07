<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;


abstract class Repository implements RepositoryInterface
{
    /**
     * @var $model
     * var $with
     */
    protected $model;
    protected $with = [];
    protected $orderBy = 'id';
    protected $orderDirection = 'asc';
    /**
     *  Construct.
     *
     * @param $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * Get all instances of model.
     *
     * @return array
     */
    public function all()
    {
        return  $this->query()->get();
    }
    /**
     *  Create a new record in the database.
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    /**
     *  Find record in the database.
     *
     * @param int $id
     * @return void
     */
    public function find(int $id)
    {
        return  $this->query()->find($id);
    }
    /**
     * Update record in the database.
     *
     * @param array $data
     * @param $where
     */
    public function update(array $data, $where)
    {
        if (is_array($where)) {

            $record =  $this->model->where($where);

        } else {

            $record =  $this->model->find($where);
        }

        return $record->update($data);
    }
    /**
     * Remove record from the database
     *
     * @param $data
     */
    public function delete($data)
    {
        if (is_array($data)) {

            return $this->model->where($data)->delete();
        } else {

            return $this->model->destroy($data);
        }
    }

    /**
     * order by record from the database
     *
     * @param string $orderBy
     * @oaram string $orderDirection
     */
    public function orderBy(string $orderBy,string $orderDirection)
    {
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     *  Where record in the database.
     *
     * @param array $data
     * @return mixed
     */
    public function where(array $data)
    {
        return $this->query()->where($data)->get();
    }

    /**
     *  Where first record in the database.
     *
     * @param array $data
     * @return mixed
     */
    public function whereOne(array $data)
    {
        return   $this->query()->where($data)->first();
    }


    /**
     *  Where not in record in the database.
     *
     * @param string $field
     * @param array $data
     * @return mixed
     */
    public function whereNotIn(string $field,array $data)
    {
        return   $this->query()->whereNotIn($field,$data)->get();
    }

    /**
     * Sets relations for eager loading.
     *
     * @param $relations
     * @return $this
     */
    public function with($relations)
    {

        if (is_string($relations))
        {
            $this->with = explode(',', $relations);

            return $this;
        }

        $this->with = is_array($relations) ? $relations : [];

        return $this;
    }

    /**
     * Creates a new QueryBuilder instance including eager loads
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function query()
    {
        return $this->model->newQuery()->with($this->with)->orderBy($this->orderBy,$this->orderDirection);
    }
}