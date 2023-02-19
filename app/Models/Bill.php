<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Bill
 *
 * @property int $id
 * @property string $type
 * @property string $unique_id
 * @property string $reference
 * @property string|null $notes
 * @property string $status
 * @property string|null $due_date
 * @property int $customer_id
 * @property int $user_id
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillItem> $billItems
 * @property-read int|null $bill_items_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUserId($value)
 * @mixin \Eloquent
 */
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
    const BILL_STATUS_SENT = 'sent';

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
     * Generate PDF
     *
     * @param bool $attachment whether to download or not
     * @return string url to pdf
     */
    public function pdf($attachment = false)
    {
        $customer = $this->customer;
        $items = $this->items();
        $company = $this->company;

        $billCustomization = auth()->user()->company->customization;

        // Build template data
        $data = [
            'bill' => $this,
            'customer' => $customer,
            'company' => $company,
            'items' => $items,
            'billCustomization' => $billCustomization,
            'due_date' => Carbon::parse($this->due_date)->format('d/m/Y'),
            'created_date' => Carbon::parse($this->created_at)->format('d/m/Y')
        ];

        // Build PDF
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.bills.bill', $data);

        if ($attachment) {
            return $pdf->output();
        } else {
            Storage::put('public/pdf/' . $this->unique_id . '.pdf', $pdf->output());

            // Get url
            $url = Storage::url('public/pdf/' . $this->unique_id . '.pdf');

            // Get domain
            $domain = url('/');

            return $domain . $url;
        }
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
