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
	* Show Company Details which user belongs to
    *
    * <aside class="notice">permission: view company</aside>
	*
	* @apiResource App\Http\Resources\CompanyResource
    * @apiResourceModel App\Models\Company
	*
    * @return \Illuminate\Http\Response
	*/
    public function show()
    {
        $company = auth()->user()->company()->first();

        $this->authorize('view', $company);

        return new CompanyResource($company);
    }

    /**
	* Update Company
	*
	* Update Company Details
    *
    * <aside class="notice">permission: update company</aside>
	*
    * @bodyParam name string required Name
	* @bodyParam address string required Address
	* @bodyParam postal_code string required Postal Code
	* @bodyParam telephone_number string required Telephone Number
	* @bodyParam logo file optional Logo
    *
	* @responseFile responses/company/update.json
	* @responseFile status=422 scenario="Validation Error" responses/company/update.validation.json
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

        $company = auth()->user()->company()->first();

        $this->authorize('update', $company);

        $attributes['logo_path'] = $company->logo($request);

        $company->update($attributes);

        return response()->json([
            'message' => 'Successfully updated company.'
        ]);
    }
}
