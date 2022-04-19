<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StoreController extends Controller
{
     /**
     * 
     * Store CRUD Operation starts here
     */

    //list all Stores
    public function list()
    {
        return Inertia::render('Admin/Stores/list', ['stores' => Store::where('user_id', Auth::user()->id)->paginate(10), 'totalstores' => count(Store::where('user_id', Auth::user()->id)->get())]);
    }


    //this function render a component to add new store
    public function create()
    {
        return Inertia::render('Admin/Stores/create');
    }


    //this function save the store in database
    public function save(StoreRequest $request)
    {

        $store = new Store();
        $store->name = $request->name;
        $phone = substr($request->phone, 1);
        $store->phone = '92'.$phone;
        $store->email = $request->email;
        $store->address = $request->address;
        $store->user_id = Auth::user()->id;
        $store->type = $request->type;

        //store image
        if($request->logo != '')
        {
            $file = $request->logo;
            $fileName = $file->getClientOriginalName(); // getting image name
            $file->move('store_logo/', $fileName);
            $store->logo = $fileName;
        }
        else
            $store->logo = 'default.png';


        if($store->save())
            return Redirect::back()->with('success', $request->name.' Created!');
        else
            return Redirect::back()->with('error', $request->name.' Not Created!');
    }


    //this function render a component to edit a specific store
    public function edit($id)
    {
        return Inertia::render('Admin/Stores/edit', ['store' => Store::find($id)]);
    }


    //this function update the store
    public function update(StoreRequest $request)
    {
        $store = Store::find($request->id);
        $store->name = $request->name;

        if($request->phone != $store->phone)
        {
            $phone = substr($request->phone, 1);
            $store->phone = '92'.$phone;
        }
        else
        {
            $store->phone = $request->phone;
        } 
        $store->email = $request->email;
        $store->address = $request->address;
        $store->type = $request->type;
        $store->user_id = Auth::user()->id;
        $store->status = $request->status;

        //store image
        if($request->logo != '')
        {
            $file = $request->logo;
            $fileName = $file->getClientOriginalName(); // getting image name
            $file->move('store_logo/', $fileName);
            $store->logo = $fileName;
        }

        

        if($store->save())
            return Redirect::route('list-store')->with('success', $request->name.' Updated!');
        else
            return Redirect::route('list-store')->with('error', $request->name.'Not Updated!');
    }


    //this function delete the store
    public function delete($id)
    {
        if(Store::find($id)->delete())
            return Redirect::route('list-store')->with('success', 'Record Deleted!');
        else
            return Redirect::route('list-store')->with('error', 'Recored Not Deleted!');
    }



    //this function show details of the store
    public function detail($id)
    {
        return Inertia::render('Admin/Stores/detail', ['store' => Store::find($id)]);
    }



    /**
     * 
     * Store CRUD Operation ends here
     */
}
