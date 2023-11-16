<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\PosInvoice;
use App\Models\POSession;
use App\Models\PosInvoiceProducts;
use App\Models\Item;
use App\Models\ItemWarehouse;
use Session;    


class POSController extends Controller
{
    public function index()
    {
        #dd(session('recent_invoices'));
        if(session('active_session')==0)
        {
            $warehouses  = Warehouse::all();
            return view ('pos.main',compact('warehouses'));
        };
        #$session = POSession::whereDate('opened_at', '=', date('Y-m-d'))->first();
        #dd($session);

        return view ('pos.main');
    }
    public function sell(Request $request)
    {
        $request->validate([
            'customer'  =>  'required',
            'products'  =>  'required',
            'quantity'  =>  'required',
            'product_price'     =>  'required',
            'Invoice_Quantity'  =>  'required',
            'Invoice_Subtotal'  =>  'required',
            'Invoice_Discount'  =>  'required',
            'Invoice_Shipping'  =>  'required',
            'Invoice_Total'     =>  'required',
        ]);
        $invoice_code = uniqid();
        $invoice = PosInvoice::insertOrIgnore([
            'customer_id'  =>  $request->customer,
            'biller_id'  =>   auth()->user()->id,
            'invoice_code'  =>  $invoice_code,
            'quantity'  =>  $request->Invoice_Quantity,
            'subtotal'  =>  $request->Invoice_Subtotal,
            'discount'  =>  $request->Invoice_Discount,
            'shipping'  =>  $request->Invoice_Shipping,
            'total'     =>  $request->Invoice_Total,
            'date'      =>  date('Y-m-d H:i:s'),
            'warehouse_id'  =>  session('warehouse'),
            'session_code'  =>  session('session_code'),
        ]);
        $request->session()->increment('session_total', $request->Invoice_Total);
        $invoice = PosInvoice::with('customer')->where('invoice_code',$invoice_code)->first();
        Session::push('recent_invoices', $invoice);
        $this->SaveInvoiceProducts($invoice , $request);
        $session = POSession::where('session_code', session('session_code'))->first();
        $session->session_total = session('session_total');
        $session->save();
        
        return redirect()->back()->with('status','Invoice Saved Successfully');
    }

    public function SaveInvoiceProducts($invoice , $request)
    {
        $ProductNumber = 0;
        foreach ($request->products as $product) {
            $invoice_product = PosInvoiceProducts::insertOrIgnore([
                'invoice_id'    =>  $invoice->id,
                'product_id'    =>  $product,
                'quantity'      =>  $request->quantity[$ProductNumber],
                'price'         =>  $request->product_price[$ProductNumber],
            ]);
            $prd = Item::find($product);
            $qty = $prd->warehouse_quantity->where('warehouse_id', '=', session('warehouse'))->first();
            $qty->quantity = $qty->quantity - $request->quantity[$ProductNumber];
            $qty->save();
            $ProductNumber++;
        }
    }

}
