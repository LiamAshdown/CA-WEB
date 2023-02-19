<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $telephone
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $postcode
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $address3
 * @property string|null $town
 * @property string|null $county
 * @property int $company_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUserId($value)
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
