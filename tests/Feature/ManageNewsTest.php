<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\News;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageNewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_many_news()
    {
        $all_news = [];

        $all_news['news'][] = factory(News::class)->make()->toArray();
        $all_news['news'][] = factory(News::class)->make()->toArray();

        $this->post(route('news.store'), $all_news)->assertStatus(200);
        $this->assertCount(2, News::all());
    }

    /** @test */
    public function the_news_requires_a_title()
    {
        $news_data = [
            'news' => [
                [
                    'category_id' => factory(Category::class)->create()->id,
                    'title' => '',
                    'body' => 'test',
                ],
            ],
        ];

        $this->post(route('news.store'), $news_data)
            ->assertStatus(302)
            ->assertSessionHasErrors('news.0.title');

        $this->assertCount(0, News::all());
    }

    /** @test */
    public function the_news_requires_an_unique_title()
    {
        factory(News::class)->create([
            'title' => 'test title'
        ]);

        $news_data = [
            'news' => [
                [
                    'category_id' => factory(Category::class)->create()->id,
                    'title' => 'test title',
                    'body' => 'test',
                ],
            ],
        ];

        $this->post(route('news.store'), $news_data)
            ->assertStatus(302)
            ->assertSessionHasErrors('news.0.title');

        $this->assertCount(1, News::all());
    }

    /** @test */
    public function the_news_requires_a_body()
    {
        $news_data = [
            'news' => [
                [
                    'category_id' => factory(Category::class)->create()->id,
                    'title' => 'test',
                    'body' => '',
                ],
            ],
        ];

        $this->post(route('news.store'), $news_data)
            ->assertStatus(302)
            ->assertSessionHasErrors('news.0.body');

        $this->assertCount(0, News::all());
    }

    /** @test */
    public function the_news_requires_a_category_id()
    {
        $news_data = [
            'news' => [
                [
                    'category_id' => NULL,
                    'title' => 'test',
                    'body' => '',
                ],
            ],
        ];

        $this->post(route('news.store'), $news_data)
            ->assertStatus(302)
            ->assertSessionHasErrors('news.0.category_id');

        $this->assertCount(0, News::all());
    }
    /** @test */
    public function the_news_requires_a_valid_category_id()
    {
        $news_data = [
            'news' => [
                [
                    'category_id' => 100,
                    'title' => 'test',
                    'body' => '',
                ],
            ],
        ];

        $this->post(route('news.store'), $news_data)
            ->assertStatus(302)
            ->assertSessionHasErrors('news.0.category_id');

        $this->assertCount(0, News::all());
    }
}
