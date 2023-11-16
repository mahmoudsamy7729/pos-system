<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\Expenses;


class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenses::with('category','user')->orderBy('id', 'DESC')->paginate(10);
        return view('expenses.expenses-list',compact('expenses'));
    }
    public function create()
    {
        $categories = ExpenseCategory::where('active',1)->get();
        return view('expenses.create-expense',compact('categories'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'amount'    =>  'required',
            'expense_for'   => 'nullable',
            'description'   => 'nullable',
        ]);        
        $expense = Expenses::insertOrIgnore([
            'date'  =>  date('Y-m-d'),
            'category_id'   =>  $request->category_id,
            'amount'    =>  $request->amount,
            'expense_for'   =>  $request->expense_for,
            'description'   =>  $request->description,
            'created_by'    =>  auth()->user()->id,
            
        ]);
        return redirect()->route('expenses.show')->with('status', 'Expense Added Successfully.');

    }
}
