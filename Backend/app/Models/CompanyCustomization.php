<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCustomization extends Model
{
    use HasFactory;

    /**
     * Permissions
     *
     * @var array
     */
    public const PERMISSIONS = [
        'view' => 'view customization',
        'update' => 'update customization'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'invoice_prefix',
		'default_invoice_body',
        'estimate_prefix',
        'default_estimate_body'
    ];
}
