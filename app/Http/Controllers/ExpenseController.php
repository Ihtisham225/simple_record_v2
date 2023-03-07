<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ExpenseController extends Controller
{
    /**
 * 
 * Expenses CRUD Operation starts here
 */

//list all expenses
public function list()
{   
    return Inertia::render('Admin/Expenses/list', 
    [
        'expenses' => Expense::where('store_id', session('store_id'))->paginate(10), 
        'totalExpenses' => Expense::where('store_id', session('store_id'))
                                    ->whereDate('created_at', Carbon::today())
                                    ->sum('amount')
    ]);
}


//this function render a component to add new brand
public function create()
{
    return Inertia::render('Admin/Expenses/create');
}


//this function save the expense in database
public function save(ExpenseRequest $request)
{
    
    $expense = new Expense();
    $expense->title = $request->title;
    $expense->amount = $request->amount;
    $expense->notes = $request->notes;
    $expense->store_id = session('store_id');
    $expense->status = 1;
    
        if($expense->save())
        return Redirect::route('create-expense')->with('success', $request->b_name.' Added!');
    else
        return Redirect::route('create-expense')->with('error', $request->b_name.' Not Added!');
}


//this function render a component to edit a specific expense
public function edit($id)
{
    return Inertia::render('Admin/Expenses/edit', ['expense' => Expense::find($id)]);
}


//this function update the Expense
public function update(ExpenseRequest $request)
{
    $expense = Expense::find($request->e_id);
    $expense->title = $request->title;
    $expense->amount = $request->amount;
    $expense->notes = $request->notes;
    $expense->store_id = session('store_id');
    $expense->status = 1;

    if($expense->save())
        return Redirect::route('list-expense')->with('success', $request->b_name.' Updated!');
    else
        return Redirect::route('list-expense')->with('error', $request->b_name.'Not Updated!');
}


//this function delete the Expense
public function delete($id)
{
    if(Expense::find($id)->delete())
        return Redirect::route('list-expense')->with('success', 'Record Deleted!');
    else
        return Redirect::route('list-expense')->with('error', 'Recored Not Deleted!');
}



/**
 * 
 * Expense CRUD Operation ends here
 */
}
