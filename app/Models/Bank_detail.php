<?php
namespace App\Models;

/**
 * Class Bank_detail
 * @package App\Models
 */
class Bank_detail extends \Eloquent
{
    protected $fillable = ['employeeID','accountName','accountNumber','bank','pan','ifsc','branch'];
    protected $guarded = [''];

    /**
     * @return mixed
     */
    public function employeeDetails()
    {
        return $this->belongsTo(Employee::class, 'employeeID', 'employeeID');
    }
}