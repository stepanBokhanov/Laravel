<?php
namespace App\Models;

/**
 * Class Employee_document
 * @package App\Models
 */
class Employee_document extends \Eloquent
{
    protected $fillable = [];
    protected $guarded = ['id'];

    protected $appends = ['document_url'];

    /**
     * @return mixed
     */
    public function employeeDetails()
    {
        return $this->belongsTo(Employee::class, 'employeeID', 'employeeID');
    }

    public function getDocumentUrlAttribute()
    {
        return asset_url($this->fileName, $this->type);
//        return asset_url('employee_documents/'.$this->type.'/'.$this->fileName);
    }
}