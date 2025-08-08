<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanBeListed()
    {
        User::factory()->count(3)->create();

        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function testUserCanBeCreated()
    {
        $response = $this->post('/users', [
            'name'     => 'John Doe',
            'email'    => 'john@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function testUserCanBeShown()
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJson(['id' => $user->id]);
    }

    public function testUserCanBeUpdated()
    {
        $user = User::factory()->create();

        $response = $this->put("/users/{$user->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }

    public function testUserCanBeDeleted()
    {
        $user = User::factory()->create();

        $response = $this->delete("/users/{$user->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
