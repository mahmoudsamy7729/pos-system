<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceProducts;
use App\Models\Item;
use App\Models\Payments;
use PDF;


class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = PurchaseInvoice::with('user','supplier','warehouse')->orderBy('id', 'DESC')->paginate(10);
        #dd($purchases);
        return view('purchase.purchase-list',compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::where('active',1)->get();
        $warehouses = Warehouse::all();
        return view('purchase.create-purchase',compact('suppliers','warehouses'));
    }

    public function save(Request $request )
    {
        $status = 1;
        $request->validate([
            'supplier'  =>  'required',
            'date'      =>  'required',
            'warehouse' =>  'required',
            'products'  =>  'required',
            'quantity'  =>  'required',
            'product_price'     =>  'required',
            'Invoice_Quantity'  =>  'required',
            'Invoice_Subtotal'  =>  'required',
            'Invoice_Discount'  =>  'required',
            'Invoice_Shipping'  =>  'required',
            'Invoice_Total'     =>  'required',
            'paid'              =>   'required|numeric|min:0|max:'.$request->Invoice_Total,
        ], [
            'paid.max' =>  'You Cant Pay More Than '.$request->Invoice_Total,
        ]);
        if($request->paid == $request->Invoice_Total)
        {
            $status = 2;
        }
        #dd($request->Invoice_Subtotal);
        $invoice_code = uniqid();
        $invoice = PurchaseInvoice::insertOrIgnore([
            'supplier_id'  =>  $request->supplier,
            'user_id'  =>   auth()->user()->id,
            'invoice_code'  =>  $invoice_code,
            'quantity'  =>  $request->Invoice_Quantity,
            'subtotal'  =>  $request->Invoice_Subtotal,
            'discount'  =>  $request->Invoice_Discount,
            'shipping'  =>  $request->Invoice_Shipping,
            'total'     =>  $request->Invoice_Total,
            'paid'      =>  $request->paid,
            'status'    =>  $status,
            'date'      =>  date('Y-m-d H:i:s'),
            'warehouse_id'  =>  $request->warehouse,
        ]);
        $invoice = PurchaseInvoice::where('invoice_code',$invoice_code)->first();
        $this->SaveInvoiceProducts($invoice , $request);
        if($request->paid > 0)
        {
            $this->PaymentInvoice($invoice , $request);
        }
        return redirect()->back()->with('status','Invoice Saved Successfully');
    }
    
    public function PaymentInvoice($invoice , $request)
    {
        $payment = Payments::insertOrIgnore([
            'invoice_id'    =>  $invoice->id,
            'payment_code'  =>  uniqid(),
            'supplier_id'   =>  $request->supplier,
            'amount'        =>  $request->paid,
            'created_by'    =>  auth()->user()->id,
            'date'          =>  date('Y-m-d H:i:s'),
        ]);
    }

    public function SaveInvoiceProducts($invoice , $request)
    {
        $ProductNumber = 0;
        foreach ($request->products as $product) {
            $invoice_product = PurchaseInvoiceProducts::insertOrIgnore([
                'invoice_id'    =>  $invoice->id,
                'product_id'    =>  $product,
                'quantity'      =>  $request->quantity[$ProductNumber],
                'price'         =>  $request->product_price[$ProductNumber],
            ]);
            $prd = Item::find($product);
            $qty = $prd->warehouse_quantity->where('warehouse_id', '=', $request->warehouse)->first();
            $qty->quantity = $qty->quantity + ($request->quantity[$ProductNumber] * $prd->qty_purchase_unit);
            $qty->save();
            $ProductNumber++;
        }
    }

    public function invoice_details($invoice_id)
    {
        $invoice = PurchaseInvoice::with('user','supplier','products','warehouse')->find($invoice_id);
        return response()->json([
            'invoice' => $invoice,
        ]);
        
    }
    /*
    public function pdf()
    {
        $purchases = PurchaseInvoice::with('user','supplier','warehouse')->orderBy('id', 'DESC')->paginate(10);
        $html = view('purchase.purchase-list', compact('purchases'))->toArabicHTML();

        $pdf = PDF::loadHTML($html)->output();
        
        $headers = array(
            "Content-type" => "application/pdf",
        );
        
        // Create a stream response as a file download
        return response()->streamDownload(
            fn () => print($pdf), // add the content to the stream
            "invoice.pdf", // the name of the file/stream
            $headers
        );
    }*/

    public function search_invoice(Request $request)
    {
        $request->validate([
            'inv_number' => 'nullable',
            'biller'    =>  'nullable',
            'warehouse' =>  'nullable',
            'supplier' =>  'nullable',
            'date'  =>  'nullable',
            'status'    =>  'nullable',
        ]);
        $purchases = PurchaseInvoice::with('user','supplier','warehouse')->where(function($query) use($request)
        {
            if($request->inv_number)
            {
                $query->where('invoice_code',$request->inv_number);   
            }
            if($request->biller)
            {
                $query->where('user_id',$request->biller);   
            }
            if($request->warehouse)
            {
                $query->where('warehouse_id',$request->warehouse);   
            }
            if($request->supplier)
            {
                $query->where('supplier_id',$request->supplier);   
            }
            if($request->date)
            {
                $query->whereDate('date',$request->date);   
            }
            if($request->status)
            {
                $query->where('status',$request->status);   
            }
        })->orderBy('id', 'DESC')->paginate(10);
        return view('purchase.purchase-list',compact('purchases'));
    }





}
