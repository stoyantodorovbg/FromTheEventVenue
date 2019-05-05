<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FetchNewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_existing_news_are_sent_to_the_news_index_page()
    {
        $news = factory(News::class, 10)->create();

        $response = $this->get(route('news.index'));

        $this->assertEquals($news->count(), $response->original->getData()['news']->count());
    }

    /** @test */
    public function the_news_can_be_seached_by_category()
    {
        factory(News::class, 10)->create();

        $searched_category = Category::find(1);

        $response = $this->post(route('news.search'), [
            'category_id' => $searched_category->id,
        ]);

        $this->assertEquals($searched_category->news->count(), $response->original->getData()['news']->count());
    }

    /** @test */
    public function the_news_can_be_seached_by_date()
    {
        $before_searched_date = Carbon::parse('2016-05-25 00:00');
        $searched_date = Carbon::parse('2017-05-25 00:00');

        factory(News::class, 10)->create([
            'created_at' => $before_searched_date,
        ]);
        factory(News::class, 2)->create([
            'created_at' => $searched_date,
        ]);

        $searched_news_count = News::where('created_at', '=', $searched_date)->get()->count();

        $response = $this->post(route('news.search'), [
            'created_at' => $searched_date,
        ]);

        $this->assertEquals($searched_news_count, $response->original->getData()['news']->count());
    }

    /** @test */
    public function the_news_can_be_seached_by_time_interval()
    {
        $before_first_searched_date = Carbon::parse('2016-05-25 00:00');
        $first_searched_date = Carbon::parse('2017-05-25 00:00');
        $after_first_before_second_searched_dates = Carbon::parse('2017-06-25 00:00');
        $second_searched_date = Carbon::parse('2017-08-25 00:00');
        $after_second_searched_date = Carbon::parse('2018-05-25 00:00');

        factory(News::class, 6)->create([
            'created_at' => $before_first_searched_date,
        ]);
        factory(News::class, 4)->create([
            'created_at' => $after_first_before_second_searched_dates,
        ]);
        factory(News::class, 14)->create([
            'created_at' => $after_second_searched_date,
        ]);

        $url = route('news.search');

        $searched_news_count = News::where('created_at', '>=', $first_searched_date)
            ->where('created_at', '<=', $second_searched_date)
            ->get()->count();
        $response = $this->post($url, [
            'created_at_after' => $first_searched_date,
            'created_at_before' => $second_searched_date,
        ]);
        $this->assertEquals($searched_news_count, $response->original->getData()['news']->count());

        $searched_news_count = News::where('created_at', '<=', $first_searched_date)->get()->count();
        $response = $this->post($url, [
            'created_at_before' => $first_searched_date,
        ]);
        $this->assertEquals($searched_news_count, $response->original->getData()['news']->count());

        $searched_news_count = News::where('created_at', '>=', $second_searched_date)->get()->count();
        $response = $this->post($url, [
            'created_at_after' => $second_searched_date,
        ]);
        $this->assertEquals($searched_news_count, $response->original->getData()['news']->count());

        $searched_news_count = News::where('created_at', '>=', $after_first_before_second_searched_dates)->get()->count();
        $response = $this->post($url, [
            'created_at_after' => $after_first_before_second_searched_dates,
        ]);
        $this->assertEquals($searched_news_count, $response->original->getData()['news']->count());

        $searched_news_count = News::where('created_at', '>=', $after_first_before_second_searched_dates)
            ->where('created_at', '<=', $second_searched_date)
            ->get()->count();
        $response = $this->post($url, [
            'created_at' => $after_first_before_second_searched_dates,
        ]);
        $this->assertEquals($searched_news_count, $response->original->getData()['news']->count());
    }

    /** @test */
    public function the_news_can_be_searched_by_category_and_time_interval_simultaniously()
    {
        $categories = factory(Category::class, 2)->create();

        $before_searched_date = Carbon::parse('2016-05-25 00:00');
        $searched_date = Carbon::parse('2017-05-25 00:00');
        $after_searched_date = Carbon::parse('2017-06-25 00:00');

        factory(News::class, 2)->create([
            'category_id' => $categories[0]->id,
            'created_at' => $before_searched_date,
        ]);

        factory(News::class, 3)->create([
            'category_id' => $categories[1]->id,
            'created_at' => $before_searched_date,
        ]);

        factory(News::class, 4)->create([
            'category_id' => $categories[0]->id,
            'created_at' => $after_searched_date,
        ]);

        factory(News::class, 5)->create([
            'category_id' => $categories[1]->id,
            'created_at' => $after_searched_date,
        ]);

        $url = route('news.search');

        $searched_news_count = News::where('created_at', '<=', $searched_date)
            ->where('category_id', $categories[0]->id)
            ->get()->count();
        $response = $this->post($url, [
            'created_at_before' => $searched_date,
            'category_id' => $categories[0]->id,
        ]);
        $this->assertEquals($searched_news_count, $response->original->getData()['news']->count());

        $searched_news_count = News::where('created_at', '>=', $searched_date)
            ->where('category_id', $categories[0]->id)
            ->get()->count();
        $response = $this->post($url, [
            'created_at_after' => $searched_date,
            'category_id' => $categories[0]->id,
        ]);
        $this->assertEquals($searched_news_count, $response->original->getData()['news']->count());
    }
}
