<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\ItemWarehouse;
use App\Traits\Common;
use Session;    



class ItemController extends Controller
{
    use Common;
    
    public function index()
    {
        $items = Item::with('user','category','warehouse_quantity')->orderBy('id', 'DESC')->paginate(10);
        return view('items.items-list',compact('items'));
    }
    public function create()
    {
        $warehouses = Warehouse::all();
        $categories = ItemCategory::where('active',1)->get();
        return view('items.create-item',compact('categories','warehouses'));
    }
    public function save(Request $request)
    {
        $warehouses = Warehouse::all();
        $request->validate([
            'name' => 'required|unique:items',
            'category_id' => 'nullable',
            'sell_unit'  =>  'required',
            'purchase_unit'  =>  'required',
            'qty_purchase_unit'  =>  'required',
            'quantity'  =>  'required',
            'min_quantity'  =>  'required',
            'expire_date'   =>  'required',
            'barcode'   =>  'required|unique:items',
            'description'   =>  'nullable',
            'image' =>  'nullable',
            'purchase_price'    =>  'required',
            'sales_price'   =>  'required',
        ], [
            'name.unique' =>  __('error item name unique'),
            'barcode.unique' => __('error item barcode unique'),
        ]);
        $i = 0;
        $item = Item::insertOrIgnore([
            'name'  =>  $request->name,
            'category_id'   =>  $request->category_id,
            'sell_unit'  =>  $request->sell_unit,
            'purchase_unit'  =>  $request->purchase_unit,
            'qty_purchase_unit'  =>  $request->qty_purchase_unit,
            'min_quantity'  =>  $request->min_quantity,
            'expire_date'   =>  $request->expire_date,
            'description'   =>  $request->description,
            'barcode'   =>  $request->barcode,
            'image' =>  $request->image,
            'purchase_price'    =>  $request->purchase_price / $request->qty_purchase_unit,
            'sales_price'   =>  $request->sales_price,
            'active'    =>  1,
            'created_by' =>  auth()->user()->id,
            'created_at' =>  date('Y-m-d'),
        ]);
        
        foreach($warehouses as $warehouse)
        {
            #dd($warehouse);

            $itemwarehouse = ItemWarehouse::insertOrIgnore([
                'item_name'   =>  $request->name,
                'warehouse_id'  =>  $warehouse->id,
                'quantity'  =>  $request->qty_purchase_unit * $request->quantity[$i],
            ]);            
            $i++;
        };
        return redirect()->route('items.show')->with('status', 'Product Added Successfully.');
    }

    public function active($id)
    {   
        $this->update($id  , Item::class);
        return response()->json(['success'=>'Updated Successfully.']);
    }

    public function search_item($query)
    {
        $items = Item::select('id','name','barcode')->where('active',1)->where('name','like', '%'.$query.'%')
        ->orWhere('barcode','like', '%'.$query.'%')->get();
        return response()->json([
            'items' => $items,
        ]);
    }
    public function item_details($id , $warehouse)
    {
        $item = Item::select('id','name','sales_price')
        ->with(['warehouse_quantity' => function($q) use($warehouse) {
            $q->where('warehouse_id', '=', $warehouse); }])
        ->find($id);
        
        return response()->json([
            'item' => $item,
        ]); 
    }

    public function pur_item_details($id )
    {
        $item = Item::find($id);
        return response()->json([
            'item' => $item,
        ]); 
    }


}
