<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Traits\Common;



class SupplierController extends Controller
{
    
    use Common;
    
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'DESC')->paginate(5);
        return view('suppliers.suppliers-list',compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create-supplier');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'nullable',
            'vat_number'   =>  'nullable',
            'email'   =>  'nullable|unique:suppliers',
            'phone'   =>  'required|unique:suppliers',
            'adress'   =>  'nullable',
        ], [
            'phone.unique' =>  __('error phone unique'),
            'email.unique' => __('error email unique'),
        ]); 
        #dd($data);
        $supplier = Supplier::insertOrIgnore([
            'name'  =>  $request->name,
            'company_name'  =>  $request->company_name,
            'vat_number'    =>  $request->vat_number,
            'email' =>  $request->email,
            'phone' =>  $request->phone,
            'adress'    =>  $request->adress,
            'active'    =>  1,
        ]);
        return redirect()->route('suppliers.show')->with('status', 'Supplier Added Successfully.');

    }
    public function active($id)
    {   
        $this->update($id  , Supplier::class);
        return response()->json(['success'=>'Updated Successfully.']);
    }

    public function get_suppliers_ajax()
    {
        $suppliers = Supplier::select('id','name')->where('active',1)->get();
        return response()->json([
            'suppliers' => $suppliers,
        ]);
    }
}
