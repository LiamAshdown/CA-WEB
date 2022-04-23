<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'telephone',
        'mobile',
        'email',
        'postcode',
        'address1',
        'address2',
        'address3',
        'town',
        'country'
    ];
}
