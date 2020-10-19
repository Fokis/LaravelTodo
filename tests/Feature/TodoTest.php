<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testEmptyList() : void
    {
        $response = $this->actingAs($this->user, 'api')
            ->getJson('api/todos');
        $response->assertStatus(200)
            ->assertJson([]);
    }

    public function testAddValidationFail() : void
    {
        $response = $this->actingAs($this->user, 'api')
            ->postJson('api/todos', ['description' => Str::random(256), 'categpry_id' => 0]);
        $response->assertStatus(422);
    }

    public function testAddSuccess() : void
    {
        $response = $this->actingAs($this->user, 'api')
            ->postJson('api/todos', ['description' => "New todo", 'categpry_id' => 0]);
        $response->assertStatus(200)
            ->assertJsonFragment(
                [
                    'description' => "New todo",
                    'category_id' => null,
                    'category'    => ''
                ]
            );
    }

    public function testNonEmptyList() : void
    {
        $this->actingAs($this->user, 'api')
            ->postJson('api/todos', ['description' => "New todo", 'categpry_id' => 0]);
        $response = $this->actingAs($this->user, 'api')
            ->getJson('api/todos');

        $response->assertStatus(200)
            ->assertJsonFragment(
                [
                    'description' => "New todo",
                    'category_id' => null,
                    'category'    => ''
                ]
            );
    }

    public function testAddRemoveSuccess() : void
    {
        $response = $this->actingAs($this->user, 'api')
            ->postJson('api/todos', ['description' => "New todo", 'categpry_id' => 0]);
        $id = $this->user->load('todos')->todos->first()->id;
        $response = $this->actingAs($this->user, 'api')
            ->deleteJson("api/todos/{$id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['ok']);
    }

    public function testRemoveFail() : void
    {
        $response = $this->actingAs($this->user, 'api')
            ->deleteJson("api/todos/100");
        $response->assertStatus(404);
    }
}
