<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

/**
 * Class Admin
 * @package App\Models
 */
class Admin extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected $fillable = ['name', 'email', 'password'];

}
