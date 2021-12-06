<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Image;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $telephone_number
 * @property string $postal_code
 * @property string $address
 * @property string|null $logo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CompanyCustomization $companyCustomization
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereTelephoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 */
class Company extends Model
{
    use HasFactory;

    /**
     * Permissions
     *
     * @var array
     */
    public const PERMISSIONS = [
        'view' => 'view company',
        'update' => 'update company'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'telephone_number',
		'postal_code',
		'address',
        'logo_path'
    ];

    /**
     * Get Company Path
     *
     * @param string $type
     * @return string
     */
    public function getPath($type, $unique = false)
    {
        return 'companies/'.$this->id.'/'.$type.'/'.($unique ? uniqid() : '');
    }

    /**
     * Handle Logo
     *
     * @param mixed $logo
     * @return string
     */
    public function logo($request)
    {
        $file = $request->file('logo');

        if ($file) {
            Storage::delete($this->logo_path);

            $path = $file->hashName($this->getPath('logo'));
            $image = Image::make($file)->fit(150);
            Storage::disk('public')->put($path, (string)$image->encode());
            return $path;
        }

        return '';
    }

	/**
    * Get Company Users
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
    * Get Company Customization
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function customization()
    {
        return $this->hasOne(CompanyCustomization::class);
    }
}
