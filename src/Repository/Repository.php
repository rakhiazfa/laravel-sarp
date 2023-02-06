<?php

namespace Rakhiazfa\LaravelSarp\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * Repository class.
 */
class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param int $perPage
     * 
     * @return mixed
     */
    public function orderByIdDesc(int $perPage = 0): mixed
    {
        return $perPage > 0 ?
            $this->model->orderBy('id', 'DESC')->paginate($perPage) :
            $this->model->orderBy('id', 'DESC')->get();
    }

    /**
     * @param array $attributes
     * 
     * @return Model
     */
    public function new(array $attributes): Model
    {
        return new Model($attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $with
     * @param array $params
     * 
     * @return Model
     */
    public function find(int $id, array $with = [], array $params = []): ?Model
    {
        return $this->model->with($with)->findOrFail($id);;
    }

    /**
     * @param int $id
     * 
     * @return Model|null
     */
    public function findOrFail(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param int $id
     * 
     * @return Model|null
     */
    public function findWithTrash(int $id): ?Model
    {
        return $this->model::query()->withTrashed()->find($id);
    }

    /**
     * @param int $id
     * 
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model::query()->find($id)->delete();
    }

    /**
     * @param int $id
     * @param array $attributes
     * 
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        $model = $this->find($id);

        return $model->update($attributes);
    }
}
