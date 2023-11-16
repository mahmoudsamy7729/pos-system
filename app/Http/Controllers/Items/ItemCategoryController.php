<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Traits\Common;


class ItemCategoryController extends Controller
{
    use Common;

    public function index()
    {
        $categories = ItemCategory::with('user')->orderBy('id', 'DESC')->paginate(10);
        return view('items.category-list',compact('categories'));
    }
    public function create()
    {
        return view('items.create-category');
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        $category = ItemCategory::insertOrIgnore([
            'name'  =>  $request->name,
            'description'  =>  $request->description,
            'active'    =>  1,
            'created_by' =>  auth()->user()->id,
            'created_at' =>  date('Y-m-d'),
        ]);
        return redirect()->route('items.categories.show')->with('status', 'Category Added Successfully.');

    }

    public function active($id)
    {   
        $this->update($id  , ItemCategory::class);
        return response()->json(['success'=>'Updated Successfully.']);
    }
}
