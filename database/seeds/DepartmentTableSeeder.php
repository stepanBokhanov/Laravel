<?php

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Designation;
class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('department')->truncate(); // deleting old records.

        \Illuminate\Support\Facades\DB::table('designation')->truncate(); // deleting old records.



        //        PHP Department
        $dept =  Department::create([
            'deptName'    =>  'PHP',

        ]);
        Designation::create([
            'deptID'    =>  $dept->id,
            'designation'   =>'Fresher PHP Developer'
        ]);

        Designation::create([
            'deptID'    =>  $dept->id,
            'designation'   =>'Senior PHP Developer'
        ]);

        // Android Department
        $dept = Department::create([
            'deptName'    =>  'Android Developer',
        ]);
        Designation::create([
            'deptID'    =>  $dept->id,
            'designation'   =>'Fresher Android Developer'
        ]);

        Designation::create([
            'deptID'    =>  $dept->id,
            'designation'   =>'Senior Android Developer'
        ]);


        // HR Department
        $dept = Department::create([
            'deptName'    =>  'Human Resource',
        ]);
        Designation::create([
            'deptID'    =>  $dept->id,
            'designation'   =>'Assistant Manager '
        ]);

        Designation::create([
            'deptID'    =>  $dept->id,
            'designation'   =>'Manager'
        ]);

        // Data Collection Department
        $dept = Department::create([
            'deptName'    =>  'Data Collection',
        ]);
        Designation::create([
            'deptID'    =>  $dept->id,
            'designation'   =>'Assistant Surveyor '
        ]);

        Designation::create([
            'deptID'    =>  $dept->id,
            'designation'   =>'Surveyor'
        ]);
    }
}
