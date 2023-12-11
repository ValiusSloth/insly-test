<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;

class UserService extends AbstractService
{
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            /** @var User $user */
            $user = parent::create($data);

            if (isset($data['address'])) {
                $user->userDetails()->create(['address' => $data['address']]);
            }

            return $user;
        });
    }

    /**
     * {@inheritDoc}
     */
    public function update(int $id, array $data): User
    {
        return DB::transaction(function () use ($id, $data) {
            /** @var User $user */
            $user = parent::update($id, $data);

            if (isset($data['address'])) {
                $user->userDetails()->updateOrCreate(['user_id' => $user->id], ['address' => $data['address']]);
            }

            return $user;
        });
    }

    /**
     * {@inheritDoc}
     */
    public function delete(int $id): User
    {
        return DB::transaction(function () use ($id) {
            return parent::delete($id);
        });
    }
}
