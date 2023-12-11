<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    /**
     * Create a new model instance
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update the specified model instance
     *
     * @param Model $model
     * @param array $data
     * @return Model 
     */
    public function update(Model $model, array $data): Model;

    /**
     * Delete the specified model instance.
     *
     * @param Model $model
     * @return void
     */
    public function delete(Model $model): void;

    /**
     * Retrieve all model instances, with optional pagination.
     *
     * @param int $perPage The number of items per page, for pagination.
     * @return LengthAwarePaginator
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator;

    /**
     * Retrieve a model instance by its ID.
     *
     * @param int $id
     * @return Model
     */
    public function getById(int $id): Model;
}
