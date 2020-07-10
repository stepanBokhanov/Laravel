<?php
namespace App\Models;

/**
 * Class Noticeboard
 * @package App\Models
 */
class Noticeboard extends \Eloquent
{

    // Don't forget to fill this array
    protected $fillable = ['title', 'description', 'status'];
}