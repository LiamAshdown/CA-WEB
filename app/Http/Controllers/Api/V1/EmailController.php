<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\BillEmail;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Initialize Email
     *
     * @param Request $request
     * @param string $type
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function init(Request $request, $type, $id)
    {
        $to = null;
        $subject = null;
        $body = null;

        switch ($type)
        {
            case 'bill':
                $bill = Bill::findOrFail($id);

                $customer = $bill->customer;

                $to = $customer->email;
                $body = "Hi {$customer->name},\n\nPlease find attached your invoice {$bill->reference}.\n\nThanks,\n{$bill->company->name}";
            break;
        }

        return response()->json([
            'to' => $to,
            'subject' => $subject,
            'body' => $body
        ]);
    }

    /**
     * Send Email
     *
     * @param Request $request
     * @return void
     */
    public function send(Request $request)
    {
        $attributes = $request->validate([
            'type' => 'required|string',
            'id' => 'required|integer',
            'to' => 'required|string',
            'cc' => 'nullable|string',
            'body' => 'required|string'
        ]);

        switch ($attributes['type'])
        {
            case 'bill':
                $bill = Bill::findOrFail($attributes['id']);

                Mail::to($attributes['to'])->send(new BillEmail($bill, $attributes['body']));

                // Set bill status to sent
                $bill->status = Bill::BILL_STATUS_SENT;
                $bill->save();
            break;
        }

        return response()->json([
            'message' => 'Email sent successfully.'
        ]);
    }
}
