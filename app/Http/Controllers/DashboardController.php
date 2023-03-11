<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Seller;
use App\Models\SoldProduct;
use App\Models\Store;
use Carbon\Carbon;
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
        $totalExpenses = Expense::where('store_id', session('store_id'))->sum('amount');
        $totalSold = SoldProduct::where('store_id', session('store_id'))->where('return_status', 0)->sum('sold_quantity');

        $totalproducts = Product::where('store_id', session('store_id'))->where('status', 1)->sum('quantity');
        $totalProfit = SoldProduct::where('store_id', session('store_id'))->where('return_status', '0')->sum('profit');

        $title = "Dashboard | All";
        $badge = "all";

        return Inertia::render('Admin/Dashboard', 
        [
            'id' => session('store_id'), 
            'totalcustomers' => $totalcustomers, 
            'totalExpenses' => $totalExpenses, 
            'totalProfit' => $totalProfit, 
            'totalproducts' => $totalproducts, 
            'totalSold' => $totalSold,
            'title' => $title,
            'badge' => $badge
        ]);
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
        $storeName = $product->store->name;
        if($product->brand_id != null)
            $brand = $product->brand->name;
        else
            $brand = $product->brand_name;
        return Inertia::render('ProductSpecs', ['product' => $product, 'brand' => $brand, 'storeName' => $storeName]);
    }




    /*****************************************************************************************************************
     * *****Filters Starts*********************************************
     */

    //fiter today
    public function filter_today($id)
    {
        session(['store_id' => $id]);

        $title = "Dashboard | Today";
        $badge = "today";

        $totalcustomers = count(Customer::where('store_id', session('store_id'))->whereDate('created_at', Carbon::today())->orWhereDate('updated_at', Carbon::today())->get());
        $totalExpenses = Expense::where('store_id', session('store_id'))->whereDate('created_at', Carbon::today())->orWhereDate('updated_at', Carbon::today())->sum('amount');
        $totalSold = SoldProduct::where('store_id', session('store_id'))->whereDate('created_at', Carbon::today())->orWhereDate('updated_at', Carbon::today())->where('return_status', 0)->sum('sold_quantity');

        $totalproducts = Product::where('store_id', session('store_id'))->whereDate('created_at', Carbon::today())->orWhereDate('updated_at', Carbon::today())->where('status', 1)->sum('quantity');
        $totalProfit = SoldProduct::where('store_id', session('store_id'))->whereDate('created_at', Carbon::today())->orWhereDate('updated_at', Carbon::today())->where('return_status', '0')->sum('profit');

        return Inertia::render('Admin/Dashboard', 
        [
            'id' => session('store_id'), 
            'totalcustomers' => $totalcustomers, 
            'totalExpenses' => $totalExpenses, 
            'totalProfit' => $totalProfit, 
            'totalproducts' => $totalproducts, 
            'totalSold' => $totalSold,
            'title' => $title,
            'badge' => $badge,
        ]);
    }


    //fiter this week
    public function filter_week($id)
    {
        session(['store_id' => $id]);

        $title = "Dashboard | This Week";
        $badge = "week";

        $totalcustomers = count(Customer::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orWhereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get());
        $totalExpenses = Expense::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orWhereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $totalSold = SoldProduct::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orWhereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('return_status', 0)->sum('sold_quantity');

        $totalproducts = Product::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orWhereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status', 1)->sum('quantity');
        $totalProfit = SoldProduct::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orWhereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('return_status', '0')->sum('profit');

        return Inertia::render('Admin/Dashboard', 
        [
            'id' => session('store_id'), 
            'totalcustomers' => $totalcustomers, 
            'totalExpenses' => $totalExpenses, 
            'totalProfit' => $totalProfit, 
            'totalproducts' => $totalproducts, 
            'totalSold' => $totalSold,
            'title' => $title,
            'badge' => $badge,
        ]);
    }


    //filter this month
    public function filter_month($id)
    {

        session(['store_id' => $id]);

        $title = "Dashboard | This Month";
        $badge = "month";

        $totalcustomers = count(Customer::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orWhereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get());
        $totalExpenses = Expense::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orWhereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('amount');
        $totalSold = SoldProduct::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orWhereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('return_status', 0)->sum('sold_quantity');

        $totalproducts = Product::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orWhereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('status', 1)->sum('quantity');
        $totalProfit = SoldProduct::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orWhereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('return_status', '0')->sum('profit');

        return Inertia::render('Admin/Dashboard', 
        [
            'id' => session('store_id'), 
            'totalcustomers' => $totalcustomers, 
            'totalExpenses' => $totalExpenses, 
            'totalProfit' => $totalProfit, 
            'totalproducts' => $totalproducts, 
            'totalSold' => $totalSold,
            'title' => $title,
            'badge' => $badge,
        ]);

    }


    //filter this year
    public function filter_year($id)
    {
        session(['store_id' => $id]);

        $title = "Dashboard | This Year";
        $badge = "year";

        $totalcustomers = count(Customer::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->orWhereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get());
        $totalExpenses = Expense::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->orWhereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount');
        $totalSold = SoldProduct::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->orWhereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('return_status', 0)->sum('sold_quantity');

        $totalproducts = Product::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->orWhereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('status', 1)->sum('quantity');
        $totalProfit = SoldProduct::where('store_id', session('store_id'))->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->orWhereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('return_status', '0')->sum('profit');

        return Inertia::render('Admin/Dashboard', 
        [
            'id' => session('store_id'), 
            'totalcustomers' => $totalcustomers, 
            'totalExpenses' => $totalExpenses, 
            'totalProfit' => $totalProfit, 
            'totalproducts' => $totalproducts, 
            'totalSold' => $totalSold,
            'title' => $title,
            'badge' => $badge,
        ]);

    }




    //filter date
    public function filter_date(Request $request, $id)
    {
        session(['store_id' => $id]);

        $title = "Dashboard | . $request->date";
        $badge = "date";

        $totalcustomers = count(Customer::where('store_id', session('store_id'))->whereDate('created_at', $request->date)->get());
        $totalExpenses = Expense::where('store_id', session('store_id'))->whereDate('created_at', $request->date)->sum('amount');
        $totalSold = SoldProduct::where('store_id', session('store_id'))->whereDate('created_at', $request->date)->where('return_status', 0)->sum('sold_quantity');

        $totalproducts = Product::where('store_id', session('store_id'))->whereDate('created_at', $request->date)->where('status', 1)->sum('quantity');
        $totalProfit = SoldProduct::where('store_id', session('store_id'))->whereDate('created_at', $request->date)->where('return_status', '0')->sum('profit');

        return Inertia::render('Admin/Dashboard', 
        [
            'id' => session('store_id'), 
            'totalcustomers' => $totalcustomers, 
            'totalExpenses' => $totalExpenses, 
            'totalProfit' => $totalProfit, 
            'totalproducts' => $totalproducts, 
            'totalSold' => $totalSold,
            'title' => $title,
            'badge' => $badge,
        ]);


    }


    /*****************************************************************************************************************
     * *****Filters Ends*********************************************
     */
}
