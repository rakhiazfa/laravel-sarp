<?php

namespace Rakhiazfa\LaravelSarp\Service;

use Rakhiazfa\LaravelSarp\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServiceImplementation implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repository;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $with
     * 
     * @return Collection
     */
    public function all(array $with = []): Collection
    {
        return $this->repository->all();
    }

    /**
     * @param array $with
     * 
     * @return Collection
     */
    public function orderByIdDesc(array $with = []): Collection
    {
        return $this->repository->orderByIdDesc();
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
        return $this->find($id, $with, $params);
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
        return $this->repository->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * 
     * @return int
     */
    public function update(int $id, array $attributes): int|bool
    {
        return $this->update($id, $attributes);
    }

    /**
     * @param int $id
     * 
     * @return int|bool
     */
    public function delete(int $id): int|bool
    {
        return $this->repository->delete($id);
    }
}
