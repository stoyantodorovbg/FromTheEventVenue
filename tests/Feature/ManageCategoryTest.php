<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
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
        ])->assertStatus(302)
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function the_category_requires_an_unique_title()
    {
        factory(Category::class)->create([
            'title' => 'test title'
        ]);

        $this->post(route('categories.store'), [
            'title' => 'test title',
        ])->assertStatus(302)
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function the_validation_prevents_category_title_lenght_greater_then_256_characters()
    {
        $this->withExceptionHandling();
        $this->post(route('categories.store'), [
            'title' => Str::random(256),
        ])->assertStatus(302)
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function the_category_can_be_updated()
    {
        $category = factory(Category::class)->create();

        $this->patch(route('categories.update', $category->slug), [
            'title' => $category->title,
        ])->assertStatus(200);

        $this->patch(route('categories.update', $category->slug), [
            'title' => 'Updated Category Title',
        ])->assertStatus(200);

        $this->assertDatabaseHas('categories', [
            'title' => 'Updated Category Title',
        ]);
    }

    /** @test */
    public function the_category_can_be_updated_only_with_unique_title()
    {
        $first_category = factory(Category::class)->create();
        $second_category = factory(Category::class)->create();

        $this->patch(route('categories.update', $second_category->slug), [
            'title' => $first_category->title,
        ])->assertStatus(302)
            ->assertSessionHasErrors('title');
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
