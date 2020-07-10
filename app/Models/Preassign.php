<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preassign extends Model
{
    protected $fillable = [
    	'employeeID',
    	'preassign_holidays'
    ];
    protected $table = 'preassign';
    
    public function employeeDetails()
    {

        return $this->belongsTo(Employee::class, 'employeeID', 'employeeID');
    }
}
