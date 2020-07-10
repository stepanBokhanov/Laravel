<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('settings')->delete(); // deleting old records.
        \Illuminate\Support\Facades\DB::table('settings')->truncate(); // Truncating old records.


        \App\Models\Setting::create([

            'website'    =>  'HRM',
            'email'      =>  'admin@example.com',
            'Name'       =>  'Administrator',
            'logo'       =>  'logo.png',
            'currency'   =>  'INR',
            'currency_icon' =>  'fa-inr',
            'award_notification'    => 1,
            'leave_notification'    => 1,
            'notice_notification'    => 1,
            'attendance_notification'    => 1,
            'employee_add'    => 1,


        ]);
    }
}
