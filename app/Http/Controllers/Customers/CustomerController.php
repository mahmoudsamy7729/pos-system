<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Traits\Common;

class CustomerController extends Controller
{
    use Common;
    public function index()
    {
        $customers = Customer::orderBy('id', 'DESC')->paginate(10);
        return view('customers.customers-list',compact('customers'));
    }
    public function create()
    {
        return view('customers.create-customer');
    }
    
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'   =>  'nullable|unique:customers',
            'phone'   =>  'required|unique:customers',
        ], [
            'phone.unique' =>  __('error phone unique'),
            'email.unique' => __('error email unique'),
        ]); 
        $customer = Customer::insertOrIgnore([
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'phone' =>  $request->phone,
            'active'    =>  1,
        ]);
        return redirect()->route('customers.show')->with('status', __('customer added successfully'));
    }

    public function active($id)
    {   
        $this->update($id  , Customer::class);
        return response()->json(['success'=>'Updated Successfully.']);
    }

    public function get_customers_ajax()
    {
        $customers = Customer::select('id','name','phone')->where('active',1)->get();
        return response()->json([
            'customers' => $customers,
        ]);
    }
}
