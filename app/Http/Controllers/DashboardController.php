<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Store;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //this function is used to select a specific store from the list of the user stores
    public function selectStore()
    {
        return Inertia::render('Admin/SelectStore', ['stores' => Store::where('user_id', Auth::user()->id)->get(), 'totalstores' => count(Store::where('user_id', Auth::user()->id)->get())]);
    }


    //Dashboard for a specific store
    public function dashboard($id)
    {
        session(['store_id' => $id]);

        $totalcustomers = count(Customer::where('store_id', session('store_id'))->get());
        $totalsellers = count(Seller::where('store_id', session('store_id'))->get());
        $totalbrands = count(Brand::where('store_id', session('store_id'))->get());
        $totalproducts = count(Product::where('store_id', session('store_id'))->get());

        return Inertia::render('Admin/Dashboard', ['id' => session('store_id'), 'totalcustomers' => $totalcustomers, 'totalsellers' => $totalsellers, 'totalbrands' => $totalbrands, 'totalproducts' => $totalproducts]);
    }


    
    /** This function Display all stores in welcome page */
    public function all_stores()
    {
        return Inertia::render('Welcome', ['stores' => Store::all()]);
    }


    //shwoing products of specific store to all users
    public function products($id){
        $store = Store::find($id);
        $owner = $store->user;
        return Inertia::render('Products', ['products' => Product::where('store_id', $id)->where('quantity', '>', 0)->get(), 'store' => $store, 'owner' => $owner]);
    }


    //product specifications
    public function productSpecs($id)
    {
        $product = Product::find($id);
        $brand = $product->brand->name;
        return Inertia::render('ProductSpecs', ['product' => $product, 'brand' => $brand]);
    }
}
