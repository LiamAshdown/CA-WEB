<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Image;

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

            $path = $file->hashName('public/company_logos');
            $image = Image::make($file)->fit(300);
            Storage::put($path, (string)$image->encode());
            return $path;
        }

        return '';
    }

	/**
    * Get Company User
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function user()
    {
        return $this->belongsToMany(User::class)->withPivot('company_id', 'user_id', 'admin');
    }
}
