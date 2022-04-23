<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_code',
        'response'
    ];

    /**
     * Get response attribute
     *
     * @var array
     */
    public function getResponseAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Set response attribute
     *
     * @var array
     */
    public function setResponseAttribute($value)
    {
        $this->attributes['response'] = json_encode($value);
    }

    /**
     * Format the addresses
     * 
     * @return array
     */
    public static function formatAddresses($addresses, $postcode)
    {
        $results = [];

        foreach ($addresses as $key => $address) {
            $results['addresses'][$key] = [
                'index' => $key,
                'formatted_address' => "{$address['line_1']}, {$address['town_or_city']}, {$address['county']}",
                'line_1' => $address['line_1'],
                'town_or_city' => $address['town_or_city'],
                'county' => $address['county'],
                'postcode' => $postcode,
                'district' => $address['district'],
                'country' => $address['country']
            ];

            $results['formatted_addresses'][] = [
                'value' => $key,
                'address' => $results['addresses'][$key],
                'text' => $results['addresses'][$key]['formatted_address']
            ];
        }
        
        return $results;
    }
}
