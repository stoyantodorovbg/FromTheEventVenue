<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Deletecriteria;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use App\Models\Archivednews;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FetchArchivednewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_archived_news_can_be_fetched()
    {
        $archived_news = factory(Archivednews::class, 12)->create();

        $response = $this->post(route('news.search'), [
            'archived' => 1,
        ]);

        $this->assertEquals($archived_news->count(), $response->original->getData()['news']->count());
    }

    /** @test */
    public function archived_news_can_be_searched_by_category()
    {
        $categories = factory(Category::class, 2)->create();

        $archived_news_1 = factory(Archivednews::class, 5)->create([
            'category_id' => $categories[0]->id,
        ]);

        $archived_news_2 = factory(Archivednews::class, 7)->create([
            'category_id' => $categories[1]->id,
        ]);

        $url = route('news.search');

        $response = $this->post($url, [
            'archived' => 1,
            'category_id' => $categories[0]->id,
        ]);
        $this->assertEquals($archived_news_1->count(), $response->original->getData()['news']->count());

        $response = $this->post($url, [
            'archived' => 1,
            'category_id' => $categories[1]->id,
        ]);
        $this->assertEquals($archived_news_2->count(), $response->original->getData()['news']->count());
    }

    /** @test */
    public function archived_news_can_be_searched_by_delete_criteria()
    {
        $delete_criterias = factory(Deletecriteria::class, 2)->create();


        $archived_news_1 = factory(Archivednews::class, 5)->create([
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);

        $archived_news_2 = factory(Archivednews::class, 7)->create([
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);

        $url = route('news.search');

        $response = $this->post($url, [
            'archived' => 1,
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);
        $this->assertEquals($archived_news_1->count(), $response->original->getData()['news']->count());

        $response = $this->post($url, [
            'archived' => 1,
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);
        $this->assertEquals($archived_news_2->count(), $response->original->getData()['news']->count());
    }

    /** @test */
    public function archived_news_can_be_searched_by_delete_criteria_and_category_simultaniously()
    {
        $delete_criterias = factory(Deletecriteria::class, 2)->create();
        $categories = factory(Category::class, 2)->create();

        $archived_news_1 = factory(Archivednews::class, 5)->create([
            'category_id' => $categories[0]->id,
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);

        $archived_news_2 = factory(Archivednews::class, 7)->create([
            'category_id' => $categories[1]->id,
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);

        $archived_news_3 = factory(Archivednews::class, 9)->create([
            'category_id' => $categories[1]->id,
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);

        $archived_news_4 = factory(Archivednews::class, 11)->create([
            'category_id' => $categories[0]->id,
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);

        $url = route('news.search');

        $response = $this->post($url, [
            'archived' => 1,
            'category_id' => $categories[0]->id,
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);
        $this->assertEquals($archived_news_1->count(), $response->original->getData()['news']->count());

        $response = $this->post($url, [
            'archived' => 1,
            'category_id' => $categories[1]->id,
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);
        $this->assertEquals($archived_news_2->count(), $response->original->getData()['news']->count());

        $response = $this->post($url, [
            'archived' => 1,
            'category_id' => $categories[1]->id,
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);
        $this->assertEquals($archived_news_3->count(), $response->original->getData()['news']->count());

        $response = $this->post($url, [
            'archived' => 1,
            'category_id' => $categories[0]->id,
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);
        $this->assertEquals($archived_news_4->count(), $response->original->getData()['news']->count());
    }

    /** @test */
    public function archived_news_can_be_searched_by_delete_criteria_and_date_simultaniously()
    {
        $delete_criterias = factory(Deletecriteria::class, 2)->create();
        $created_date = Carbon::parse('2017-05-25 00:00');
        $after_created_date = Carbon::parse('2017-06-25 00:00');

        $archived_news_1 = factory(Archivednews::class, 5)->create([
            'created_at' => $created_date,
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);

        $archived_news_2 = factory(Archivednews::class, 7)->create([
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);

        $archived_news_3 = factory(Archivednews::class, 9)->create([
            'created_at' => $created_date,
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);

        $archived_news_4 = factory(Archivednews::class, 11)->create([
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);

        $url = route('news.search');

        $response = $this->post($url, [
            'archived' => 1,
            'created_at' => $created_date,
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);
        $this->assertEquals($archived_news_1->count(), $response->original->getData()['news']->count());

        $response = $this->post($url, [
            'archived' => 1,
            'created_at_after' => $after_created_date,
            'deletecriteria_id' => $delete_criterias[0]->id,
        ]);
        $this->assertEquals($archived_news_2->count(), $response->original->getData()['news']->count());

        $response = $this->post($url, [
            'archived' => 1,
            'created_at' => $created_date,
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);
        $this->assertEquals($archived_news_3->count(), $response->original->getData()['news']->count());

        $response = $this->post($url, [
            'archived' => 1,
            'created_at_after' => $after_created_date,
            'deletecriteria_id' => $delete_criterias[1]->id,
        ]);
        $this->assertEquals($archived_news_4->count(), $response->original->getData()['news']->count());
    }
}
