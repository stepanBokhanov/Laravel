<?php
namespace App\Models;

class Department extends \Eloquent
{


    protected $table = 'department';

    // Don't forget to fill this array
    protected $fillable = [];

    protected $guarded = ['id'];

    /**
     * @return mixed
     */

    public function Designations()
    {
        return $this->hasMany(Designation::class, 'deptID', 'id');
    }
}