<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomizationResource;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id6
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $customization = auth()->user()->company->customization;

        $this->authorize('view', $customization);

        return new CustomizationResource($customization);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'invoice_prefix'	     => 'required|string',
			'default_invoice_body'   => 'nullable|string',
			'estimate_prefix' 	     => 'required|string',
			'default_estimate_body'  => 'nullable|string',
			'terms_conditions'       => 'nullable|string'
        ]);

        $customization = auth()->user()->company->customization;

        $this->authorize('update', $customization);

        $customization->update($attributes);

        return response()->json([
            'message' => 'Successfully updated customization settings.'
        ]);
    }
}
