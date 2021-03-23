<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'telephone_number',
		'postal_code',
		'address'
    ];

	/**
    * Get Company User
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function user()
    {
        return $this->belongsToMany(User::class, 'company_users')->withPivot('company_id', 'user_id', 'admin');
    }
}
