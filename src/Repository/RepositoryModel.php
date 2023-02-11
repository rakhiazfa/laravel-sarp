<?php

namespace Rakhiazfa\LaravelSarp\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * RepositoryModel class.
 */
class RepositoryModel implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return Collection
     */
    public function orderByIdDesc(): Collection
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    /**
     * @param int $id
     * @param array $with
     * @param array $params
     * 
     * @return Model|null
     */
    public function find(int $id, array $with = [], array $params = []): ?Model
    {
        return $this->model->with($with)->findOrFail($id);
    }

    /**
     * @param array $attributes
     * 
     * @return Model
     */
    public function new(array $attributes = []): Model
    {
        return new Model($attributes);
    }

    /**
     * @param array $attributes
     * 
     * @return Model
     */
    public function create(array $attributes = []): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * 
     * @return int
     */
    public function update(int $id, array $attributes): int|bool
    {
        return $this->find($id)->update($attributes);
    }

    /**
     * @param int $id
     * 
     * @return int|bool
     */
    public function delete(int $id): int|bool
    {
        return $this->model::query()->find($id)->delete();
    }
}
