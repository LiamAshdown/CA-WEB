<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;
use App\Http\Resources\BillResourceCollection;
use App\Http\Resources\ItemResource;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Storage;

class BillController extends Controller
{
    /**
     * Initialize new Bill
     *
     * @return \Illuminate\Http\Response
     */
    public function init(Request $request)
    {
        $bill = new Bill();
        $bill->user_id = auth()->user()->id;
        $bill->company_id = auth()->user()->company->id;
        $bill->type = $request->type;
        $bill->status = Bill::BILL_STATUS_DRAFT;
        $bill->unique_id = uniqid('bill_');
        $bill->customer_id = $request->customer_id;
        $bill->reference = $bill->generateReference();
        $bill->save();

        return response()->json([
            'message' => 'Successfully created bill.',
            'data' => new BillResource($bill)
        ]);
    }

    /**
     * Get Bills
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function bills(Request $request)
    {
        $bills = [];

        if ($request->type) {
            $bills = auth()->user()->company->bills()->where('type', $request->type)->orderBy('id', 'desc')->get();
        } else {
            $bills = auth()->user()->company->bills()->orderBy('id', 'desc')->get();
        }

        return new BillResourceCollection($bills);
    }

    /**
     * Update Bill
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'id' => 'required|exists:bills,id',
            'type' => 'nullable|in:invoice,quote',
            'status' => 'nullable|in:draft,sent,paid,cancelled',
            'reference' => 'nullable|string',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        $bill = Bill::find($attributes['id']);
        $bill->update($attributes);

        return response()->json([
            'message' => 'Successfully updated bill.',
            'data' => new BillResource($bill)
        ]);
    }

    /**
     * Add Bill Item
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function addBillItem(Request $request)
    {
        $attributes = $request->validate([
            'bill_id' => 'required|exists:bills,id',
            'description' => 'required|string',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'vat' => 'required|numeric'
        ]);

        $bill = Bill::find($attributes['bill_id']);

        $item = new Item($attributes);
        $item->unit_price = round($attributes['unit_price'], 2);
        $item->net = round($item->quantity * $item->unit_price, 2);
        $item->gross = round($item->net * (1 + $item->vat / 100), 2);
        $item->vat = $attributes['vat'];
        $item->user_id = auth()->user()->id;
        $item->company_id = auth()->user()->company->id;
        $item->save();

        $billItem = new BillItem();
        $billItem->bill_id = $bill->id;
        $billItem->item_id = $item->id;
        $billItem->save();

        return response()->json([
            'message' => 'Successfully added bill item.',
            'data' => new ItemResource($item)
        ]);
    }

    /**
     * Update Bill Item
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateBillItem(Request $request)
    {
        $attributes = $request->validate([
            'id' => 'required|exists:items,id',
            'description' => 'required|string',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'vat' => 'required|numeric'
        ]);

        $item = Item::find($attributes['id']);

        $item->description = $attributes['description'];
        $item->quantity = $attributes['quantity'];
        $item->unit_price = round($attributes['unit_price'], 2);
        $item->net = round($item->quantity * $item->unit_price, 2);
        $item->gross = round($item->net * (1 + $item->vat / 100), 2);
        $item->vat = $attributes['vat'];
        $item->user_id = auth()->user()->id;
        $item->company_id = auth()->user()->company->id;
        $item->save();

        return response()->json([
            'message' => 'Successfully updated bill item.',
            'data' => new ItemResource($item)
        ]);
    }

    /**
     * View PDF Bill
     *
     * @param Request $request
     * @return void
     */
    public function viewPDF(Request $request)
    {
        $bill = Bill::find($request->id);
        $customer = $bill->customer;
        $items = $bill->items();
        $company = $bill->company;

        // Build template data
        $data = [
            'bill' => $bill,
            'customer' => $customer,
            'company' => $company,
            'items' => $items,
            'due_date' => Carbon::parse($bill->due_date)->format('d/m/Y'),
            'created_date' => Carbon::parse($bill->created_at)->format('d/m/Y')
        ];

        // Build PDF
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.bills.bill', $data);

        Storage::put('public/pdf/' . $bill->unique_id . '.pdf', $pdf->output());

        // Get url
        $url = Storage::url('public/pdf/' . $bill->unique_id . '.pdf');

        // Get domain
        $domain = url('/');

        return response()->json([
            'message' => 'Successfully generated PDF.',
            'url' => $domain.$url
        ]);
    }
}
