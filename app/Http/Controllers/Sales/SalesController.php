<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\PosInvoice;
use App\Models\PurchaseInvoice;

use PDF;


class SalesController extends Controller
{
    public function index()
    {
        $invoices = PosInvoice::with('biller','customer','warehouse')->whereDate('date', '=', date('Y-m-d'))->orderBy('id', 'DESC')->paginate(10);
        #dd($invoices);
        return view('sales.sales-list',compact('invoices'));
    }

    public function create()
    {
        $warehouse = Warehouse::all();
        return view('sales.create-sale',compact('warehouse'));
    }

    public function invoice_details($invoice_id)
    {
        $invoice = PosInvoice::with('biller','customer','products','warehouse')->find($invoice_id);
        return response()->json([
            'invoice' => $invoice,
        ]);
    }

    public function invoice_pdf($invoice_id)
    {
        $invoice = PosInvoice::with('biller','customer','products','warehouse')->find($invoice_id);
        $html = view('sales.pdf.invoice-pdf',compact('invoice'))->toArabicHTML();
        $pdf = PDF::loadHTML($html)->output();
        return @\PDF::loadHTML($html, 'utf-8')->stream();
    }

    public function search_invoice(Request $request)
    {
        $request->validate([
            'inv_number' => 'nullable',
            'biller'    =>  'nullable',
            'warehouse' =>  'nullable',
            'customer' =>  'nullable',
            'date'  =>  'nullable',
        ]);
        $invoices = PosInvoice::with('biller','customer','warehouse')->where(function($query) use($request)
        {
            if($request->inv_number)
            {
                $query->where('invoice_code',$request->inv_number);   
            }
            if($request->biller)
            {
                $query->where('biller_id',$request->biller);   
            }
            if($request->warehouse)
            {
                $query->where('warehouse_id',$request->warehouse);   
            }
            if($request->customer)
            {
                $query->where('customer_id',$request->customer);   
            }
            if($request->date)
            {
                $query->whereDate('date',$request->date);   
            }
        })->orderBy('id', 'DESC')->paginate(10);
        return view('sales.sales-list',compact('invoices'));
    }
}
