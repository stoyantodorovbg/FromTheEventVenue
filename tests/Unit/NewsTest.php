<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\News;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_category()
    {
        $news = factory(News::class)->create();

        $this->assertInstanceOf(Category::class, $news->category);
    }
}
