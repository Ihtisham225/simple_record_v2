<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CustomerController extends Controller
{
     /**
     * 
     * Customer CRUD Operation starts here
     */

    //list all Custoemr
    public function list()
    {
        return Inertia::render('Admin/Customers/list', ['customers' => Customer::where('store_id', session('store_id'))->with('product')->paginate(10), 'totalcustomers' => count(Customer::where('store_id', session('store_id'))->get())]);
    }


    //this function render a component to add new customer
    public function create()
    {
        return Inertia::render('Admin/Customers/create');
    }


    //this function save the customer in database
    public function save(CustomerRequest $request)
    {

        $customer = new Customer();
        $customer->name = $request->c_name;
        $customer->phone = $request->phone;
        $customer->cnic = $request->cnic;
        $customer->address = $request->address;
        $customer->store_id = session('store_id');
        $customer->status = 1;


        if($customer->save())
            return Redirect::route('create-customer')->with('success', $request->c_name.' Created!');
        else
            return Redirect::route('create-customer')->with('error', $request->c_name.' Not Created!');
    }


    //this function render a component to edit a specific customer
    public function edit($id)
    {
        return Inertia::render('Admin/Customers/edit', ['customer' => Customer::find($id), 'products' => Product::all()]);
    }


    //this function update the customer
    public function update(CustomerRequest $request)
    {
        $customer = Customer::find($request->c_id);
        $customer->name = $request->c_name;
        $customer->phone = $request->phone;
        $customer->cnic = $request->cnic;
        $customer->address = $request->address;
        $customer->store_id = session('store_id');
        $customer->status = $request->status;

        

        if($customer->save())
            return Redirect::route('list-customer')->with('success', $request->c_name.' Updated!');
        else
            return Redirect::route('list-customer')->with('error', $request->c_name.'Not Updated!');
    }


    //this function delete the customer
    public function delete($id)
    {
        if(Customer::find($id)->delete())
            return Redirect::route('list-customer')->with('success', 'Record Deleted!');
        else
            return Redirect::route('list-customer')->with('error', 'Recored Not Deleted!');
    }



    //this function show details of the customer
    public function detail($id)
    {
        return Inertia::render('Admin/Customers/detail', ['customer' => Customer::find($id)]);
    }



    /**
     * 
     * Customer CRUD Operation ends here
     */
}
