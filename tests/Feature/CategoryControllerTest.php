<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use MichelMelo\JazzRh\Models\Category;
use MichelMelo\JazzRh\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CategoryControllerTest extends TestCase
{
    #[Test]
    public function it_can_get_all_categories()
    {
        Category::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/categories');
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_create_a_category()
    {
        $data = [
            'name' => 'TI',
            'description' => 'Tecnologia da Informação',
            'color' => '#123456',
            'icon' => 'laptop',
            'type' => 'department',
        ];
        $response = $this->postJson('/api/v1/categories', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'TI']);
    }

    #[Test]
    public function it_can_get_a_category()
    {
        $category = Category::factory()->create();
        $response = $this->getJson("/api/v1/categories/{$category->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $category->id]);
    }

    #[Test]
    public function it_returns_404_for_non_existent_category()
    {
        $response = $this->getJson('/api/v1/categories/99999');
        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create();
        $data = [
            'name' => 'Atualizado',
            'description' => 'Nova descrição',
            'color' => '#654321',
            'icon' => 'update',
            'type' => 'sector',
        ];
        $response = $this->putJson("/api/v1/categories/{$category->id}", $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Atualizado']);
    }

    #[Test]
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();
        $response = $this->deleteJson("/api/v1/categories/{$category->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }
}
