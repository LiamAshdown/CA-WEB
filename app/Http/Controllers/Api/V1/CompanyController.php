<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;

/**
 * @group Company
 */
class CompanyController extends Controller
{
    /**
	* Show Company
	*
    * @return \Illuminate\Http\Response
	*/
    public function show()
    {
        $company = auth()->user()->company;

        return new CompanyResource($company);
    }

    /**
	* Update Company
	*
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
	*/
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'name'			    => 'required|string',
			'address' 		    => 'required|string',
			'postal_code' 	    => 'required|string',
			'telephone_number' 	=> 'required|string',
            'logo'              => 'nullable|mimes:jpeg,png,jpg'
        ]);

        $company = auth()->user()->company;

        $attributes['logo_path'] = $company->logo($request);

        $company->update($attributes);

        return response()->json([
            'message' => 'Successfully updated company.'
        ]);
    }
}
