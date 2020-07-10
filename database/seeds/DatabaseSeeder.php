<?php

use App\Models\Award;
use App\Models\Leavetype;
use App\Models\Noticeboard;
use App\Models\Setting;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Eloquent::unguard();

        $this->call('SettingTableSeeder');
        $this->command->info('Setting table seeded!');

        $this->call('AdminTableSeeder');
        $this->command->info('User table seeded!');

        if(env('APP_ENV') == 'development' || env('APP_ENV') == 'demo' || env('APP_ENV')!='codecanyon'){
            $this->call('DepartmentTableSeeder');
            $this->command->info('Department table seeded!');
            $this->command->info('Designation also table seeded!');

            $this->call('EmployeesTableSeeder');
            $this->command->info('Employees table seeded!');

            $this->call('NoticeBoardSeeder');
            $this->command->info('Notice Board seeded');
        }

        $this->call('LeaveTypeSeeder');
        $this->command->info('LeaveType table seeded!');



        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

}