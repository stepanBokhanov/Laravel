<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('admins')->truncate(); // deleting old records.

        \App\Models\Admin::create(
            [
                'name'  =>  'Admin',
                'email' => 'admin@example.com',
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'last_login'    => '2018-06-06 16:03:49'
            ]
        );
    }
}
