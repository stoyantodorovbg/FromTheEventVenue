<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class ArchivednewsTableSeeder extends Seeder
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
            factory(\App\Models\Archivednews::class, 2)->create([
                'category_id' => $category_id,
                'deletecriteria_id' => rand(1, 3),
                'created_at' => Carbon::parse('2019-02-25 00:00'),

            ]);

            $category_id++;
        }

        $category_id = 1;
        while ($category_id <= 10) {
            factory(\App\Models\Archivednews::class, 2)->create([
                'category_id' => $category_id,
                'deletecriteria_id' => rand(1, 3),
                'created_at' => Carbon::parse('2019-04-25 00:00'),

            ]);

            $category_id++;
        }

        $category_id = 1;
        while ($category_id <= 10) {
            factory(\App\Models\Archivednews::class, 2)->create([
                'category_id' => $category_id,
                'deletecriteria_id' => rand(1, 3),
                'created_at' => Carbon::parse('2019-05-25 00:00'),

            ]);

            $category_id++;
        }
    }
}
