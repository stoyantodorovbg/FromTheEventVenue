<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_category_can_be_created()
    {
        $this->withExceptionHandling();

        $this->post(route('categories.store'), [
            'title' => 'test category',
        ])->assertStatus(200);

        $this->assertDatabaseHas('categories', [
            'title' => 'test category',
        ]);
    }

    /** @test */
    public function the_category_has_properly_created_slug()
    {
        $this->post(route('categories.store'), [
            'title' => 'Test Category',
        ]);

        $this->assertDatabaseHas('categories', [
            'slug' => 'test-category',
        ]);
    }

    /** @test */
    public function the_category_requires_a_title()
    {
        $this->post(route('categories.store'), [
            'title' => '',
        ])->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function the_validation_prevents_category_title_lenght_greater_then_256_characters()
    {
        $this->withExceptionHandling();
        $this->post(route('categories.store'), [
            'title' => Str::random(256),
        ])->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function the_category_can_be_updated()
    {
        $category = factory(Category::class)->create();

        $this->patch(route('categories.update', $category->slug), [
            'title' => 'Updated Category Title',
        ])->assertStatus(200);

        $this->assertDatabaseHas('categories', [
            'title' => 'Updated Category Title',
        ]);
    }

    /** @test */
    public function the_category_updating_generates_a_proper_slug()
    {
        $category = factory(Category::class)->create();

        $this->patch(route('categories.update', $category->slug), [
            'title' => 'Updated Category Title',
        ]);

        $this->assertDatabaseHas('categories', [
            'slug' => 'updated-category-title',
        ]);
    }

    /** @test */
    public function the_category_can_be_deleted()
    {
        $category = factory(Category::class)->create();

        $this->delete(route('categories.destroy', $category->slug))
            ->assertStatus(200);

        $this->assertDatabaseMissing('categories', [
            'title' => $category->title,
        ]);
    }
}
