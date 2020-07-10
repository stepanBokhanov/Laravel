<?php

use Illuminate\Database\Seeder;

class NoticeBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('noticeboards')->truncate(); // deleting old records.
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            \App\Models\Noticeboard::create([
                'title' => $faker->realText(30),
                'description' => $faker->realText(200),
                'status' => 'active'

            ]);
        }
    }
}
