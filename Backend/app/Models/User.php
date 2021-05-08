<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $company_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()cl
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Roles
     *
     * @var array
     */
    public const ROLES = [
        'company_admin' => 'company admin',
        'company_sub_admin' => 'company sub admin',
        'company_user' => 'company user'
    ];

    /**
     * Permissions
     *
     * @var array
     */
    public const PERMISSIONS = [
        'view' => 'view user',
        'update' => 'update user',
        'store' => 'store user'
    ];

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }

    /**
     * Set Password Attribute
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        if (trim($password) === '') {
            return;
        }

        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Get Company Id
     *
     * @return int
     */
    public function companyId()
    {
        return $this->company->id;
    }

    /**
     * Get Company Users
     *
     * @return mixed
     */
    public function users()
    {
        return $this->company->users();
    }

    /**
    * Get Company
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get Taxes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    /**
     * Get Customers
     *
     * @return mixed
     */
    public function customers()
    {
        if ($this->hasRole(self::ROLES['company_admin']) || $this->hasRole(self::ROLES['company_sub_admin'])) {
            return Customer::where('company_id', $this->companyId())->get();
        }

        return Customer::where('user_id', $this->id)->get();
    }

    /**
     * Get Items
     *
     * @return mixed
     */
    public function items()
    {
        if ($this->hasRole(self::ROLES['company_admin']) || $this->hasRole(self::ROLES['company_sub_admin'])) {
            Item::where('company_id', $this->companyId())->get();
        }

        return Item::where('user_id', $this->id)->get();
    }
}
