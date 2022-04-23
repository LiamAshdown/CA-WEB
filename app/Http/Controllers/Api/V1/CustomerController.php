<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
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
        return new CustomerResourceCollection(auth()->user()->company->customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'nullable',
            'first_name' => 'required',
            'last_name' => 'required',
            'telephone' => 'nullable',
            'mobile' => 'nullable',
            'email' => 'nullable|email',
            'postcode' => 'required',
            'address1' => 'nullable',
            'address2' => 'nullable',
            'address3' => 'nullable',
            'town' => 'nullable',
            'county' => 'nullable'
        ]);

        $customer = new Customer($attributes);
        $customer->user_id = auth()->user()->id;
        $customer->company_id = auth()->user()->company->id;
        $customer->save();

        return response()->json([
            'message' => 'Successfully created customer.',
            'data' => new CustomerResource($customer)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $attributes = $request->validate([
            'id' => 'required|exists:customers,id',
            'title' => 'nullable',
            'first_name' => 'required',
            'last_name' => 'required',
            'telephone' => 'nullable',
            'mobile' => 'nullable',
            'email' => 'nullable|email',
            'postcode' => 'required',
            'address1' => 'nullable',
            'address2' => 'nullable',
            'address3' => 'nullable',
            'town' => 'nullable',
            'county' => 'nullable'
        ]);

        $customer = Customer::find($attributes['id']);
        $customer->update($attributes);

        return response()->json([
            'message' => 'Successfully updated customer.',
            'data' => new CustomerResource($customer)
        ]);
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
