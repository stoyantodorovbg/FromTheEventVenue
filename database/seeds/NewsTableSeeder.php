<?php

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
            ]);

            $category_id++;
        }
    }
}
