<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property string|null $website
 * @property string|null $email
 * @property string|null $telephone_number
 * @property string|null $billing_name
 * @property string|null $billing_telephone_number
 * @property string|null $billing_postal_code
 * @property string|null $billing_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBillingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBillingPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBillingTelephoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTelephoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereWebsite($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'website',
		'email',
		'telephone_number',
        'billing_name',
        'billing_telephone_number',
        'billing_postal_code',
        'billing_address'
    ];
}
