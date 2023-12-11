<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $userRepository = new UserRepository();
        $this->userService = new UserService($userRepository);
    }

    public function testCreateUser(): void
    {
        $userData = User::factory()->make()->toArray();
        $createdUser = $this->userService->create($userData);

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);
    }

    public function testCreateUserWithAddress(): void
    {
        $userData = User::factory()->make()->toArray();
        $userData['address'] = '123 Main Street';
        $createdUser = $this->userService->create($userData);

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);
        $this->assertDatabaseHas('user_details', ['user_id' => $createdUser->id, 'address' => '123 Main Street']);
    }

    public function testUpdateUser(): void
    {
        $user = User::factory()->create();
        $updateData = ['first_name' => 'Jane', 'last_name' => 'Doe'];

        $updatedUser = $this->userService->update($user->id, $updateData);

        $this->assertEquals('Jane', $updatedUser->first_name);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'first_name' => 'Jane']);
    }

    public function testDeleteUser(): void
    {
        $user = User::factory()->create();

        $this->userService->delete($user->id);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function testGetAllUsers(): void
    {
        User::factory()->count(5)->create();

        $users = $this->userService->getAll();

        $this->assertCount(5, $users);
    }

    public function testGetUserById(): void
    {
        $user = User::factory()->create();

        $foundUser = $this->userService->getById($user->id);

        $this->assertEquals($user->id, $foundUser->id);
    }
}
