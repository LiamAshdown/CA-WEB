<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    /**
     * Bill Types
     */
    const BILL_TYPE_ESTIMATE = 'estimate';
    const BILL_TYPE_INVOICE = 'invoice';

    /**
     * Bill Statuses
     */
    const BILL_STATUS_DRAFT = 'draft';

    /**
     * Bill Items
     * 
     * @var array
     */
    private ?array $items = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'due_date',
        'reference',
        'status',
        'type',
        'notes'
    ];

    /**
     * Get Bill Items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billItems()
    {
        return $this->hasMany(BillItem::class);
    }

    /**
     * Get Items
     *
     * @return array
     */
    public function items()
    {
        $billItems = $this->billItems()->get();

        $items = [];

        foreach ($billItems as $billItem) {
            $items[] = $billItem->item;
        }

        return $items;
    }

    /**
     * Get Total
     *
     * @return int
     */
    public function total()
    {
        if ($this->items === null) {
            $this->items = $this->items();
        }

        if ($this->items) {
            return number_format(array_sum(array_column($this->items, 'gross')), 2);
        }

        return 0.00;
    }

    /**
     * Get Sub Total
     *
     * @return int
     */
    public function subTotal()
    {
        if ($this->items === null) {
            $this->items = $this->items();
        }

        if ($this->items) {
            return number_format(array_sum(array_column($this->items, 'net')), 2);
        }

        return 0.00;
    }

    /**
     * Get Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
     * Generate Reference
     *
     * @return string
     */
    public function generateReference()
    {
        $bill = $this->orderBy('id', 'desc')->first();

        if ($bill) {
            $number = $bill->number;
        } else {
            $number = 0;
        }

        $customer = $this->customer;

        $postcode = '';

        if ($customer && $customer->postcode) {
            $postcode = $customer->postcode;
        } else {
            $postcode = auth()->user()->company->postcode;
        }

        if (!$postcode) {
            $postcode = '0000';
        } else {
            $postcode = str_replace(' ', '', $postcode);
        }

        return $postcode . ++$number;
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }
}
