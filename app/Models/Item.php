<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property string $description
 * @property float $vat
 * @property float $unit_price
 * @property int $quantity
 * @property float $net
 * @property float $gross
 * @property int $user_id
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereGross($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereVat($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'vat',
        'unit_price',
        'quantity',
        'net',
        'gross'
    ];
}
