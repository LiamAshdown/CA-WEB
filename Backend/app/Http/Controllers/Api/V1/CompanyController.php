<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CompanyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'name'			    => 'required|string',
			'address' 		    => 'required|string',
			'postal_code' 	    => 'required|string',
			'telephone_number' 	=> 'required|string',
        ]);

        auth()->user()->company()->update($attributes);

        return response()->json([
            'message' => 'Successfully updated company.'
        ]);
    }
}
