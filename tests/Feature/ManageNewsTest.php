<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\News;
use App\Models\Category;
use App\Models\Deletecriteria;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageNewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_one_news()
    {
        $all_news = [];

        $all_news['news'][] = factory(News::class)->make()->toArray();

        $this->post(route('news.store'), $all_news)->assertStatus(200);
        $this->assertCount(1, News::all());
    }

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

    /** @test */
    public function the_news_can_be_updated()
    {
        $news = factory(News::class)->create();

        $news_data = [
            'news' => [
                [
                    'category_id' => $news->category_id,
                    'title' => $news->title,
                    'body' => 'Updated news body',
                    'event' => 'Updated event',
                    'location' => 'Updated location',
                ],
            ],
        ];

        $this->patch(route('news.update', $news->slug), $news_data)
            ->assertStatus(200);

        $this->assertDatabaseHas('news', [
            'body' => 'Updated news body',
            'event' => 'Updated event',
            'location' => 'Updated location',
        ]);
    }

    /** @test */
    public function the_news_can_be_updated_only_with_unique_title()
    {
        $first_news = factory(News::class)->create();
        $second_news = factory(News::class)->create();

        $news_data = [
            'news' => [
                [
                    'category_id' => $second_news->category_id,
                    'title' => $first_news->title,
                    'body' => 'Updated news body',
                    'event' => $second_news->event,
                    'location' => $second_news->location,
                ],
            ],
        ];

        $this->patch(route('news.update', $second_news->slug), $news_data)
            ->assertStatus(302)
            ->assertSessionHasErrors('news.0.title');

        $this->assertDatabaseMissing('news', [
            'body' => 'Updated news body',
        ]);
    }

    /** @test */
    public function the_news_can_be_deleted_by_criteria()
    {
        $deletecriteria = factory(Deletecriteria::class)->create();
        $news = factory(News::class)->create();

        $this->delete(route('news.destroy', $news->slug), [
            'deletecriteria_id' => $deletecriteria->id,
            'note' => 'Fake news.',
        ])->assertStatus(200);

        $this->assertDatabaseMissing('news', [
            'title' => $news->title,
        ]);

        $this->assertDatabaseHas('archivednews', [
            'title' => $news->title,
            'body' => $news->body,
            'deletecriteria_id' => $deletecriteria->id,
            'note' => 'Fake news.',
        ]);
    }

    /** @test */
    public function the_news_can_not_be_deleted_by_unexisting_criteria()
    {
        $news = factory(News::class)->create();

        $this->delete(route('news.destroy', $news->slug), [
            'deletecriteria_id' => 1,
            'note' => 'Fake news.',
        ])->assertStatus(302)
            ->assertSessionHasErrors('deletecriteria_id');

        $this->assertDatabaseHas('news', [
            'title' => $news->title,
        ]);

        $this->assertDatabaseMissing('archivednews', [
            'title' => $news->title,
            'body' => $news->body,
            'note' => 'Fake news.',
        ]);
    }

    /** @test */
    public function the_news_can_be_viewed()
    {
        $news = factory(News::class)->create();

        $this->get(route('news.show', $news))
            ->assertStatus(200)
            ->assertSee($news->category->title)
            ->assertSee($news->title)
            ->assertSee($news->body)
            ->assertSee($news->event)
            ->assertSee($news->location);
    }

    /** @test */
    public function the_create_news_can_be_accessed()
    {
        $categories = factory(Category::class, 10)->create();

        $response = $this->get(route('news.create'))
            ->assertStatus(200)
            ->assertSee('CREATE NEWS');

        $this->assertEquals($categories->count(), $response->original->getData()['categories']->count());
    }
}
