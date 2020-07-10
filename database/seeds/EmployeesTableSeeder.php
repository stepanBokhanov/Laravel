<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('employees')->truncate(); // deleting old records.
        DB::table('awards')->truncate(); // deleting old records.
        $faker = Faker\Factory::create();

        \App\Models\Employee::create([
            'employeeID'    => '123456',
            'fullName'      => $faker->firstName.' '.$faker->lastName,
            'email'         => 'employee@example.com',
            'password'      => '123456',
            'gender'        => $faker->randomElement(['male','female']),
            'fatherName'    => $faker->name,
            'mobileNumber'  => rand(1, 9),
            'designation'   => rand(1, 4),
            'joiningDate'   => $faker->dateTimeBetween('-2 years')->format('Y-m-d'),
            'localAddress'  => $faker->address, 'permanentAddress' => $faker->address,
            'status'        => 'active',
            'last_login' => $faker->dateTime,
        ]);

        for ($i=0; $i < 20; $i++) {
            $employeeID[ $i ] = $faker->randomNumber(9);
            \App\Models\Employee::create([
                'employeeID'    => $employeeID[ $i ],
                'fullName'      => $faker->firstName.' '.$faker->lastName,
                'email'         => $faker->email,
                'password'      => '123456',
                'gender'        => $faker->randomElement(['male','female']),
                'fatherName'    => $faker->name,
                'mobileNumber'  => rand(1, 9),
                'designation'   => rand(1, 4),
                'joiningDate'   => $faker->dateTimeBetween('-2 years')->format('Y-m-d'),
                'localAddress'  => $faker->address, 'permanentAddress' => $faker->address,
                'status'        => 'active',
                'last_login' => $faker->dateTime,
            ]);
        }

        for ($i=0; $i < 10; $i++) {
            \App\Models\Award::create([
                'employeeID' => $employeeID[rand(0,19)],
                'awardName'  => 'Employee of the Month',
                'gift'       => 'pen',
                'cashPrice'  => rand(100,4000),
                'forMonth'   => strtolower($faker->monthName),
                'foryear'    => '2014'

            ]);
        }
    }
}
