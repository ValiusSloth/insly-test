<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function testIndexReturnsDataInValidFormat(): void
    {
        User::factory(3)->withDetails()->create();

        $this->json('GET', '/api/users')
             ->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     '*' => ['id', 'first_name', 'last_name', 'email']
                 ]
             ]);
    }

    public function testUserIsCreatedSuccessfully(): void
    {
        $userData = [
            'first_name' => 'John',
            'name' => 'UserName',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'secret123456',
        ];

        $this->json('POST', '/api/users', $userData)
             ->assertStatus(201)
             ->assertJsonStructure(['data'=> ['name', 'email', 'first_name', 'last_name']]);
    }

    public function testShowReturnsUserData(): void
    {
        $user = User::factory()->create();

        $this->json('GET', "/api/users/{$user->id}")
             ->assertStatus(200)
             ->assertJson([
                'data' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email
                ]
             ]);
    }

    public function testUserIsUpdatedSuccessfully(): void
    {
        $user = User::factory()->create();
        $updateData = ['first_name' => 'Jane', 'last_name' => 'Smith'];

        $this->json('PUT', "/api/users/{$user->id}", $updateData)
             ->assertStatus(200)
             ->assertJson([
                'data' => [
                    'first_name' => 'Jane',
                    'last_name' => 'Smith'
                ]
             ]);
    }

    public function testUserIsDeletedSuccessfully(): void
    {
        $user = User::factory()->create();

        $this->json('DELETE', "/api/users/{$user->id}")
             ->assertStatus(204);
    }
}