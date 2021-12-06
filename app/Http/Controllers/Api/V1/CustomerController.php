<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResourceCollection;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CustomerResourceCollection(auth()->user()->customers());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'name'                      => 'required|unique:customers',
            'website'                   => 'nullable',
            'email'                     => 'nullable',
            'telephone_number'          => 'nullable',
            'billing_name'              => 'nullable',
            'billing_telephone_number'  => 'nullable',
            'billing_postal_code'       => 'nullable',
            'billing_address'           => 'nullable'
        ]);

        $customer = new Customer($attributes);
        $customer->company_id = auth()->user()->companyId();
        $customer->user_id = auth()->id();
        $customer->save();

        return response()->json(['message' => 'Successfully created customer.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
