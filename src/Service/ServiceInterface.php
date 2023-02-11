<?php

namespace Rakhiazfa\LaravelSarp\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @return Collection
     */
    public function orderByIdDesc(): Collection;

    /**
     * @param int $id
     * @param array $with
     * @param array $params
     * 
     * @return Model|null
     */
    public function find(int $id, array $with = [], array $params = []): ?Model;

    /**
     * @param array $attributes
     * 
     * @return Model
     */
    public function new(array $attributes = []): Model;

    /**
     * @param array $attributes
     * 
     * @return Model
     */
    public function create(array $attributes = []): Model;

    /**
     * @param int $id
     * @param array $attributes
     * 
     * @return int
     */
    public function update(int $id, array $attributes): int|bool;

    /**
     * @param int $id
     * 
     * @return int|bool
     */
    public function delete(int $id): int|bool;
}
