<?php

use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
// use PDF;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test/', function () {
//     // return view('pdf.invoices.invoice1');
//     $pdf = App::make('dompdf.wrapper');
//     $pdf->loadView('pdf.invoices.invoice1');
//     return $pdf->stream();
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {   
    $bill = Bill::find(50);
    $customer = $bill->customer;
    $items = $bill->items();

    // Build template data
    $data = [
        'bill' => $bill,
        'customer' => $customer,
        'company' => $bill->company,
        'items' => $items,
        'due_date' => Carbon::parse($bill->due_date)->format('d/m/Y'),
        'created_date' => Carbon::parse($bill->created_at)->format('d/m/Y')
    ];
    return view('pdf.bills.bill', $data);
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadView('pdf.bills.bill', $data);
    return $pdf->stream();
});