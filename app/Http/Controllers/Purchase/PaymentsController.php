<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseInvoice;
use App\Models\Payments;


class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payments::orderBy('id', 'DESC')->paginate(10);
        return view('purchase.payments-list',compact('payments'));
    }
    public function payInvoice($invoice_id , Request $request , $max_value)
    {
        $request->validate([
            'paid' => 'required|numeric|min:0|max:'.$max_value,
        ], [
            'paid.max' =>  'You Cant Pay More Than '.$max_value,
        ]);
        $purchase = PurchaseInvoice::find($invoice_id);
        $purchase->paid = $purchase->paid + $request->paid;
        if($purchase->paid == $purchase->total)
        {
            $purchase->status = 2 ; 
        }
        $purchase->save();
        $payment = Payments::insertOrIgnore([
            'invoice_id'    =>  $invoice_id,
            'payment_code'  =>  uniqid(),
            'supplier_id'   =>  $purchase->supplier_id,
            'amount'        =>  $request->paid,
            'created_by'    =>  auth()->user()->id,
            'date'          =>  date('Y-m-d H:i:s'),
        ]);
        return redirect()->back();
    }

}
