<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
     /**
     * 
     * User CRUD Operation starts here
     */

    //list all Users
    public function list()
    {
        return Inertia::render('Admin/Users/list', ['customers' => User::all()]);
    }


    //this function render a component to add new User
    public function create()
    {
        return Inertia::render('Admin/Users/create');
    }


    //this function save the User in database
    public function save(UserRequest $request)
    {
        //save user
        //password encryption
        $password = $request->user_password;
        $confirm_password = $request->user_confirm_password;

        if($password === $confirm_password)
        {
            $password = Hash::make($password);
        }

        $user = new User();
        $user->name = $request->user_name;
        $user->phone = $request->user_phone;
        $user->email = $request->user_email;
        $user->password = $password;
        $user->is_admin = 0;
        $user->status = 1;

        $user->save();

        //save store
        $store = new Store();
        $store->name = $request->store_name;
        $store->phone = $request->store_phone;
        $store->email = $request->store_email;
        $store->address = $request->store_address;
        $store->type = $request->store_type;
        $store->user_id = $user->id;
        $store->status = 1;

        if($store->save())
            return Redirect::route('login')->with('success', $request->name.' Created!');
        else
            return Redirect::route('create-user')->with('error', $request->name.' Not Created!');
    }


    //this function render a component to edit a specific user
    public function edit($id)
    {
        return Inertia::render('Admin/Users/edit', ['user' => User::find($id)]);
    }


    //this function update the User
    public function update(UserRequest $request)
    {
        //password encryption
        $password = $request->password;
        $confirm_password = $request->confirm_password;

        if($password === $confirm_password)
        {
            $password = Hash::make($password);
        }

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $password;
        $user->is_admin = 0;

        

        if($user->save())
            return Redirect::route('list-user')->with('success', $request->name.' Updated!');
        else
            return Redirect::route('list-user')->with('error', $request->name.'Not Updated!');
    }


    //this function delete the user
    public function delete($id)
    {
        if(User::find($id)->delete())
            return Redirect::route('list-user')->with('success', 'Record Deleted!');
        else
            return Redirect::route('list-user')->with('error', 'Recored Not Deleted!');
    }



    //this function show details of the user
    public function detail($id)
    {
        return Inertia::render('Admin/Users/detail', ['user' => User::find($id)]);
    }



    /**
     * 
     * User CRUD Operation ends here
     */
}
