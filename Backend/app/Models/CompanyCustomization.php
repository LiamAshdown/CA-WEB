<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CompanyCustomization
 *
 * @property int $id
 * @property string $invoice_prefix
 * @property string|null $default_invoice_body
 * @property string $estimate_prefix
 * @property string|null $default_estimate_body
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization whereDefaultEstimateBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization whereDefaultInvoiceBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization whereEstimatePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization whereInvoicePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCustomization whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'default_estimate_body',
        'terms_conditions'
    ];
}
