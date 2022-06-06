<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\BaseModel;
use App\Repositories\Interfaces\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected BaseModel $model;

    /**
     * For caching records returned by find() method, through request lifecycle
     * @var BaseModel[]
     */
    protected static array $cache;

    /**
     * Columns to return in paginate query
     */
    protected $simple_columns = [
        '*',
    ];

    public function __construct(BaseModel $model)
    {
        $this->model = $model;
    }

    public function paginate(int $limit)
    {
        return $this->model::query()->paginate($limit, $this->simple_columns);
    }

    /**
     * @throws NotFoundException
     */
    public function find(int $id): BaseModel
    {
        if (!isset(static::$cache[$id])) {
            static::$cache[$id] = $this->model->find($id);
        }

        if (!static::$cache[$id]) {
            throw new NotFoundException();
        }

        return static::$cache[$id];
    }

    public function create(array $data): BaseModel
    {
        $model = new ($this->model);
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * @throws NotFoundException
     */
    public function update(int $id, array $data)
    {
        $model = $this->find($id);
        $model->fill($data);
        $model->save();
    }

    /**
     * @throws NotFoundException
     */
    public function delete(int $id)
    {
        $this->find($id)->delete($id);
    }
}
