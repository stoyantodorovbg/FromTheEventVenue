<?php

use Illuminate\Database\Seeder;

class DeletecriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Deletecriteria::class)->create([
            'title' => 'Error',
        ]);

        factory(\App\Models\Deletecriteria::class)->create([
            'title' => 'Misleading information',
        ]);

        factory(\App\Models\Deletecriteria::class)->create([
            'title' => 'Other',
        ]);
    }
}
