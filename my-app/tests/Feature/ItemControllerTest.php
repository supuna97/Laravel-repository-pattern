<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_item(): void
    {
        $payload = [
            'name' => 'Test Item',
            'description' => 'Desc',
            'price' => 100
        ];

        $response = $this->postJson('/v1/items/create', $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Item created successfully']);

        $this->assertDatabaseHas('items', ['name' => 'Test Item']);
    }

    #[Test]
    public function it_fails_validation_on_create(): void
    {
        $payload = ['name' => '', 'price' => 'abc'];
        $response = $this->postJson('/v1/items/create', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'price']);
    }

    #[Test]
    public function it_gets_item_list(): void
    {
        Item::factory()->count(3)->create();
        $response = $this->getJson('/v1/items/list');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    #[Test]
    public function it_gets_item_by_id_or_404(): void
    {
        $item = Item::factory()->create([
            'name' => 'Single Item',
        ]);

        // Success case
        $response = $this->getJson("/v1/items/{$item->id}");
        $result = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $result);
        $this->assertEquals('Single Item', $result['data']['name']);
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Single Item']);

        // Not Found case
        $response404 = $this->getJson("/v1/items/999"); // Non-existent ID
        $response404->assertStatus(422)
            ->assertJsonFragment(['message' => 'The selected id is invalid.']);
    }

    #[Test]
    public function it_updates_item_with_patch(): void
    {
        $item = Item::factory()->create(['name' => 'Old Name', 'price' => 100]);
        $payload = ['price' => 500];

        $response = $this->patchJson("/v1/items/update/{$item->id}", $payload);
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Item updated successfully']);

        $this->assertDatabaseHas('items', ['id' => $item->id, 'price' => 500]);

        // Update non-existent item
        $response404 = $this->patchJson("/v1/items/update/999", $payload);
        $response404->assertStatus(422)
            ->assertJsonFragment(['message' => 'The selected id is invalid.']);
    }

    #[Test]
    public function it_soft_deletes_item(): void
    {
        $item = Item::factory()->create();

        $response = $this->deleteJson("/v1/items/delete/{$item->id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Item deleted successfully']);

        $this->assertSoftDeleted('items', ['id' => $item->id]);

        // Delete non-existent
        $response404 = $this->deleteJson("/v1/items/delete/999");
        $response404->assertStatus(404)
            ->assertJsonFragment(['message' => 'Item not found']);
    }
}
