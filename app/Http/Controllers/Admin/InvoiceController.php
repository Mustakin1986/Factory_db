<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function get_all_invoice(){
        $invoices =Invoice::all();
        return response()->json([
        'invoices'=> $invoices
        ],200);
    }

    public function create_invoice(){
$invoice = Invoice::orderBY('id','DESC')->first();
    if ($invoice) {
        $invoice =$invoice+1;
    }else{
        $invoice =$invoice;
    }
    return response()->json(['success'],200);
    }
}
