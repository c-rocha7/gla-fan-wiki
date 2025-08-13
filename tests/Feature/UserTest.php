<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Inicia a sessão para os testes
        Session::start();
    }

    public function testUserCanBeListed()
    {
        User::factory()->count(3)->create();

        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function testUserCanBeCreated()
    {
        $csrfToken = csrf_token();

        $response = $this->post('/users', [
            'name'     => 'John Doe',
            'email'    => 'john@example.com',
            'password' => 'password',
            '_token'   => $csrfToken,
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
        $user      = User::factory()->create();
        $csrfToken = csrf_token();

        $response = $this->put("/users/{$user->id}", [
            'name'   => 'Updated Name',
            '_token' => $csrfToken,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }

    public function testUserCanBeDeleted()
    {
        $user      = User::factory()->create();
        $csrfToken = csrf_token();

        $response = $this->delete("/users/{$user->id}", [
            '_token' => $csrfToken,
        ]);

        $response->assertStatus(204);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
