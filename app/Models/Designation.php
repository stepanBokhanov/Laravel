<?php
namespace App\Models;

/**
 * Class Designation
 * @package App\Models
 */
class Designation extends \Eloquent
{

    protected $fillable = [];
    protected $table = 'designation';
    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    protected function department()
    {
        return $this->belongsTo(Department::class, 'deptID', 'id');
    }
}