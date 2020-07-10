<?php

namespace App\Models;

/**
 * Class Award
 * @package App\Models
 */
class Award extends \Eloquent
{

    // Don't forget to fill this array
    protected $guarded = ['id'];

    protected $fillable = ['employeeID', 'awardName', 'gift','cashPrice','forMonth','forYear'];

    /**
     * @return mixed
     */
    public function employeeDetails()
    {

        return $this->belongsTo(Employee::class, 'employeeID', 'employeeID');
    }

}