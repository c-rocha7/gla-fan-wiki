<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CharacterTest extends TestCase
{
    use RefreshDatabase;

    public function testCharacterCanBeListed()
    {
        Character::factory()->count(3)->create();

        $response = $this->get('/api/characters');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function testCharacterCanBeCreated()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post('/api/characters', [
            'name'  => 'Test Character',
            'icon'  => UploadedFile::fake()->image('icon.png'),
            'image' => UploadedFile::fake()->image('image.png'),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('characters', ['name' => 'Test Character']);
    }

    public function testCharacterCanBeShown()
    {
        $character = Character::factory()->create();

        $response = $this->get("/api/characters/{$character->id}");

        $response->assertStatus(200);
        $response->assertJson(['id' => $character->id]);
    }

    public function testCharacterCanBeUpdated()
    {
        $character = Character::factory()->create();

        $response = $this->put("/api/characters/{$character->id}", [
            'name' => 'Updated Character',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('characters', ['id' => $character->id, 'name' => 'Updated Character']);
    }

    public function testCharacterCanBeDeleted()
    {
        $character = Character::factory()->create();

        $response = $this->delete("/api/characters/{$character->id}");

        $response->assertStatus(204);
        $this->assertSoftDeleted('characters', ['id' => $character->id]);
    }
}
