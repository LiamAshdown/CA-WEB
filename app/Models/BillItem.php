<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BillItem
 *
 * @property int $id
 * @property int $bill_id
 * @property int $item_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BillItem extends Model
{
    use HasFactory;

    /**
     * Get Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
