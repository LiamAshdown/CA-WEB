<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Storage;

class BillController extends Controller
{
    /**
     * Initialize a new estimate
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'estimate_number' => 'required|numeric',
            'customer' => 'required',
            'due_date' => 'required',
            'items' => 'required|array',
            'prefix' => 'required',
            'taxes' => 'nullable|array',
            'terms_conditions' => 'nullable|array',
            'estimate_body' => 'nullable|string'
        ]);

        // Create Estimate
        $estimate = new Bill();
        $estimate->type = Bill::BILL_TYPE_ESTIMATE;
        $estimate->unique_id = uniqid();
        $estimate->number = $attributes['estimate_number'];
        $estimate->due_date = $attributes['due_date'];
        $estimate->customer_id = $attributes['customer']['id'];
        $estimate->user_id = auth()->id();
        $estimate->save();

        $items = [];

        // Store the Items
        foreach($attributes['items'] as $item) {
            $billItem = new BillItem();
            $billItem->quantity = $item['quantity'];
            $billItem->net = $item['price']; // TODO; Don't trust client sending the price?
            $billItem->bill_id = $estimate->id;
            $billItem->item_id = $item['id'];
            $billItem->save();

            $items[] = $billItem;
        }

        // Prepare attributes to build PDF
        $attributes['type'] = 'Estimate';
        $attributes['company'] = auth()->user()->company;
        $attributes['number'] = $attributes['estimate_number'];
        $attributes['due_date'] = $estimate->due_date;
        $attributes['creation_date'] = $estimate->created_at;
        $attributes['items'] = $items;

        $pdf = App::make('dompdf.wrapper');
        // TODO; The client sends everything we need. Ideally we should fetch the results
        // from the database by the ids, but for now I don't think this is an actual issue.
        // There's no benefit for the person if they want to spoof the client.
        $pdf->loadView('pdf.bills.bill', $attributes);

        $fileName = $attributes['company']->getPath('estimates').$estimate->unique_id.'.pdf';

        Storage::disk('public')->put($fileName, $pdf->output());
        
        return response()->json(['message' => 'Successfully created estimate.']);
    }

    /**
     * Initialize a new estimate
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewDraft(Request $request)
    {
        $test = 0;
    }
}
