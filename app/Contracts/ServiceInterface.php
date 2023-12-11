<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceInterface
{
    /**
     * Create a new model instance based on the provided data.
     *
     * @param array $data Data to create a new model instance.
     * @return Model The newly created model instance.
     */
    public function create(array $data): Model;

    /**
     * Update an existing model instance identified by the given ID with the provided data.
     *
     * @param int   $id   The ID of the model to update.
     * @param array $data Data to update the model instance.
     * @return Model The updated model instance.
     */
    public function update(int $id, array $data): Model;

    /**
     * Delete an existing model instance identified by the given ID.
     *
     * @param int $id The ID of the model to delete.
     * @return Model The deleted model instance.
     */
    public function delete(int $id): Model;

    /**
     * Retrieve all instances of the model, with optional pagination.
     *
     * @param int $perPage The number of items per page for pagination.
     * @return LengthAwarePaginator A collection of model instances.
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator;

    /**
     * Retrieve a single model instance by its ID.
     *
     * @param int $id The ID of the model to retrieve.
     * @return Model The found model instance.
     */
    public function getById(int $id): Model;
}
