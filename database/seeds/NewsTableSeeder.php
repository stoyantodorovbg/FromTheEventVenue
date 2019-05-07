<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_id = 1;
        while ($category_id <= 10) {
            factory(\App\Models\News::class, 2)->create([
                'category_id' => $category_id,
                'created_at' => Carbon::parse('2019-01-25 00:00'),
            ]);

            $category_id++;
        }

        $category_id = 1;
        while ($category_id <= 10) {
            factory(\App\Models\News::class, 2)->create([
                'category_id' => $category_id,
                'created_at' => Carbon::parse('2019-03-25 00:00'),
            ]);

            $category_id++;
        }

        $category_id = 1;
        while ($category_id <= 10) {
            factory(\App\Models\News::class, 2)->create([
                'category_id' => $category_id,
                'created_at' => Carbon::parse('2019-05-05 00:00'),
            ]);

            $category_id++;
        }
    }
}
