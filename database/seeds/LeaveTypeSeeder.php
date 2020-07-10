<?php

use Illuminate\Database\Seeder;
use App\Models\Leavetype;
class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('leavetypes')->truncate(); // deleting old records.
        $faker = Faker\Factory::create();


        Leavetype::create([

            'leaveType'    =>  'sick',
            'num_of_leave'    =>  5
        ]);

        Leavetype::create([
            'leaveType'    =>  'casual',
            'num_of_leave'    =>  5
        ]);

        Leavetype::create([
            'leaveType'    =>  'half day',
            'num_of_leave'    =>  5
        ]);

        Leavetype::create([

            'leaveType'    =>  'maternity',
            'num_of_leave'    =>  0
        ]);
        Leavetype::create([
            'leaveType'    =>  'unpaid',
            'num_of_leave'    =>  0
        ]);
        Leavetype::create([
            'leaveType'    =>  'others',
            'num_of_leave'    =>  0
        ]);
    }
}
