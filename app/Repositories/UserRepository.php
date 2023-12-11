<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements RepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * {@inheritDoc}
     */    
    public function update(Model $user, array $data): Model
    {
        $user->update($data);
        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Model $user): void
    {
        $user->delete();
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return User::paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getById(int $id): User
    {
        return User::findOrFail($id);
    }
}
