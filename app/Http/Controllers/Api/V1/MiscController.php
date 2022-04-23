<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PostCode;
use Illuminate\Http\Request;

class MiscController extends Controller
{
    /**
     * Look Up Post Code
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lookUpPostCode(Request $request)
    {
        $attributes = $request->validate([
            'postcode' => 'required|string'
        ]);

        $attributes['postcode'] = str_replace(' ', '', $attributes['postcode']);

        // Check if a postcode search already exists
        $postcode = PostCode::where('post_code', $attributes['postcode'])->first();

        if ($postcode) {
            return response()->json([
                'addresses' => PostCode::formatAddresses($postcode['response'], $attributes['postcode'])
            ]);
        }

        $guzzle = new \GuzzleHttp\Client();

        $response = $guzzle->get('https://api.getAddress.io/find/' . $attributes['postcode'], [
            'query' => [
                'api-key' => env('POSTCODE_API_KEY'),
                'expand' => 'true' // Has to be a string
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $response = json_decode($response->getBody()->getContents(), true);

            if (isset($response['addresses'])) {
                $postcode = PostCode::create([
                    'post_code' => $attributes['postcode'],
                    'response' => $response['addresses']
                ]);

                return response()->json([
                    'addresses' => PostCode::formatAddresses($response['addresses'], $attributes['postcode'])
                ]);
            }
        }

        return response()->json([
            'addresses' => []
        ]);
    }
}
