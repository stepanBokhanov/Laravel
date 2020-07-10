<?php
namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Expense
 * @package App\Models
 */
class Expense extends \Eloquent
{
    use Sluggable;

    // Don't forget to fill this array
    protected $fillable = ['itemName','purchaseFrom','purchaseDate','price'];


    protected $appends = ['bill_url'];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'itemName'
            ]
        ];
    }

    // Add your validation rules here
    public static $rules = [
        'itemName' => 'required',
        'price' => 'required'
    ];



    public function setPurchaseDateAttribute($value)
    {
        $this->attributes['purchaseDate'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getBillUrlAttribute()
    {
        return asset_url('expense/bills/'.$this->bill, null);

    }

}
