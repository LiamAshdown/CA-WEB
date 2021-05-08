<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaxResourceCollection;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TaxResourceCollection(auth()->user()->taxes()->get());
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
            'name' => 'required',
            'description' => 'nullable',
            'tax' => 'required'
        ]);

        $tax = new Tax();
        $tax->name = $attributes['name'];
        $tax->description = $attributes['description'];
        $tax->tax = $attributes['tax'];
        $tax->user_id = auth()->id();
        $tax->company_id = auth()->user()->companyId();
        $tax->save();

        return response()->json(['message' => 'Successfully created new tax']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tax = Tax::find($id);

        $this->authorize('view', $tax);

        return $tax;
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
        $tax = Tax::find($id);

        $this->authorize('update', $tax);

        return $tax;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Tax::find($id);

        $this->authorize('delete', $tax);

        $tax->delete();

        return response()->json(['message' => 'Successfully deleted tax']);
    }
}
