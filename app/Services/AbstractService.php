<?php

namespace App\Services;

use App\Contracts\RepositoryInterface;
use App\Contracts\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractService implements ServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function __construct(protected RepositoryInterface $repository) { }

    /**
     * {@inheritDoc}
     */
    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    /**
     * {@inheritDoc}
     */
    public function update(int $id, array $data): Model
    {
        $model = $this->repository->getById($id);
        return $this->repository->update($model, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(int $id): Model
    {
        $model = $this->repository->getById($id);
        $this->repository->delete($model);
        return $model;
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->getAll($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getById(int $id): Model
    {
        return $this->repository->getById($id);
    }
}
