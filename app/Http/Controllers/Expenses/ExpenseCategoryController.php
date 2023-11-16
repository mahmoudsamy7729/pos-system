<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Traits\Common;



class ExpenseCategoryController extends Controller
{
    use Common;
    public function index()
    {
        $categories = ExpenseCategory::with('user')->orderBy('id', 'DESC')->paginate(10);
        return view('expenses.category-list',compact('categories'));
    }
    public function create()
    {
        return view('expenses.create-category');
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        $description = '';
        if($request->description != null)
        {
            $description   =  $request->description;
        };
        $category  =ExpenseCategory::create([
            'name'  =>  $request->name,
            'description'   =>  $description,
            'active'    =>  1,
            'created_at'    =>  date('Y-m-d'),
            'created_by'    =>  auth()->user()->id,
        ]);
        return redirect()->route('expenses.categories.show')->with('status', 'Category Added Successfully.');
    }
    public function active($id)
    {   
        $this->update($id  , ExpenseCategory::class);
        return response()->json(['success'=>'Updated Successfully.']);
    }
}
