<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;


class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouses.warehouses-list',compact('warehouses'));
    }

    public function create()
    {
        return view('warehouses.create-warehouse');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name'  =>  'required',
            'phone' =>  'required|unique:warehouse',
            'email' =>  'nullable|unique:warehouse',
            'adress'    =>  'required',
        ], [
            'phone.unique'  =>   __('error phone unique'),
            'email.unique'  =>   __('error email unique'),
        ]);
        $warehouse = Warehouse::insertOrIgnore([
        'name'  =>  $request->name,
        'phone' =>  $request->phone,
        'email' =>  $request->email,
        'adress'    =>  $request->adress,
        ]);
        return redirect()->route('warehouses.show')->with('status', 'Warehouse Added Successfully.');
    }

    public function get_warehouses_ajax()
    {
        $warehouses = Warehouse::select('id','name')->get();
        return response()->json([
            'warehouses' => $warehouses,
        ]);
    }
    
}
