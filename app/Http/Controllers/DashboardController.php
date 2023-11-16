<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\POSession;
use App\Models\PosInvoice;
use App\Models\PurchaseInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;




class DashboardController extends Controller
{
    public function index()
    {
        #return (new StockCountExport(1))->download('invoices.xlsx');
        #return Excel::store(new StockCountExport, 'dd.xlsx', 'real_public');
        $monthly_sales = POSession::select('session_total','opened_at')->whereYear('opened_at',date('Y'))->get()->groupBy(function($data)
        {
            return Carbon::parse($data->opened_at)->format('M');
        });
        $monthly_expenses = Expenses::select('amount','date')->whereYear('date',date('Y'))->get()->groupBy(function($data)
        {
            return Carbon::parse($data->date)->format('M');
        });
        #dd($monthly_expenses);
        $months = ['Jan' , 'Feb' , 'Mar' , 'Apr' , 'May' , 'Jun' , 'Jul' , 'Aug' , 'Sep' , 'Oct' , 'Nov' , 'Dec'];
        $total_sales_monthes = [0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0];
        $total_expenses_monthes = [0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0];
        foreach($monthly_sales as $month => $value)
        {            
            $total_sales_monthes[Carbon::parse('1 '.$month.'')->month - 1] = $value->sum('session_total');
        }
        foreach($monthly_expenses as $month => $value)
        {            
            $total_expenses_monthes[Carbon::parse('1 '.$month.'')->month - 1] = $value->sum('amount');
        }
        #dd($total_sales_monthes);
        $monthly_sales = POSession::whereMonth('opened_at', '=', date('m'))->sum('session_total');
        $monthly_expenses = Expenses::whereMonth('date', '=', date('m'))->sum('amount'); 
        $recent_sales = PosInvoice::with('customer')->latest('id')->take(5)->get();
        $recent_expenses = Expenses::with('category','user')->latest('id')->take(5)->get();
        $recent_purchases = PurchaseInvoice::with('supplier')->latest('id')->take(5)->get();


        return view('index',
        compact('monthly_sales','monthly_expenses','recent_sales','recent_expenses','months','total_sales_monthes','total_expenses_monthes','recent_purchases'));
    }

}
