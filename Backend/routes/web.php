<?php

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
