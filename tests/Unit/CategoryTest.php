<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\News;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_news()
    {
        $category = factory(Category::class)->create();

        $news = factory(News::class, 5)->create([
            'category_id' => $category->id,
        ]);

        $this->assertInstanceOf(News::class, $category->news->first());
        $this->assertCount(5, $category->news);
    }
}
