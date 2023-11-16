<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\POSession;
use App\Models\Warehouse;
use Session;    


class SessionController extends Controller
{
    public function start_session(Request $request)
    {
        $session_code = uniqid();
        $request->validate([
            'warehouse' =>  'required',
            'cash_in_hand'  =>  'required',
        ]);
        $session = POSession::insertOrIgnore([
            'warehouse_id'  =>  $request->warehouse,
            'cash_in_hand'  =>  $request->cash_in_hand,
            'session_code'  =>  $session_code,
            'user_id'       =>  auth()->user()->id,
            'opened_at'     =>  date('Y-m-d H:i:s'),
            'status'        =>  1,
        ]);
        $request->session()->regenerate();
        session(['active_session'    => 1]);
        session(['session_code' =>  $session_code]);
        session(['session_total' => 0]);
        session(['started_at' => date('Y-m-d H:i:s')]);
        session(['warehouse' => $request->warehouse]);
        $warehouse_name = Warehouse::find($request->warehouse);
        $warehouse_name = $warehouse_name->name;
        session(['warehouse_name' => $warehouse_name]);
        return redirect()->route('pos.show');
    }

    public function close_session(Request $request)
    {
        $session = POSession::where('session_code', session('session_code'))->first();
        $session->status = 2;
        $session->closed_at = date('Y-m-d H:i:s');
        
        $request->session()->forget(['session_code', 'active_session' , 'session_total' , 'started_at' , 'recent_invoices']);
        return redirect()->route('pos.show');
    }

    public function index()
    {
        $sessions = POSession::with('biller','warehouse')->orderBy('id', 'DESC')->paginate(10);
        #dd($sessions);
        return view('session.sessions-list',compact('sessions'));
    }
}
