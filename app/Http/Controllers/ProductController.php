<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Seller;
use App\Models\SoldProduct;
use App\Models\Store;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use Maestroerror\HeicToJpg;

class ProductController extends Controller
{
    /**
     * 
     * Products CRUD Operation starts here
     */

    //list all products
    public function list()
    {
        
        $totalbudget = Product::where('store_id', session('store_id'))->where('status', '1')->pluck('price');
        $totalquantity = Product::where('store_id', session('store_id'))->where('status', '1')->pluck('quantity');
        $overallbudget = 0;

        foreach ($totalquantity as $quantity)
        {
            foreach ($totalbudget as $budget)
            {
                $overallbudget += $quantity * $budget; 
            }
        }
       
        return Inertia::render('Admin/Products/list', 
            [
                'products' => Product::where('store_id', session('store_id'))
                                    ->with('brand', 'seller', 'customer')
                                    ->latest()
                                    ->paginate(10), 
                'store_name' => Store::find(session('store_id'))->name,
                'totalbudget' => $overallbudget, 
                'totalproducts' => count(Product::where('store_id', session('store_id'))->where('status', '1')->get())
            ]);
    }


    //this function render a component to add new product
    public function create()
    {
        return Inertia::render('Admin/Products/create', ['brands' => Brand::where('store_id', session('store_id'))->get(), 'sellers' => Seller::where('store_id', session('store_id'))->get()]);
    }


    //this function save the product in database
    public function save(ProductRequest $request)
    {
        //product images
        if($request->hasFile('p_images')) 
        {
            $names = [];
            foreach($request->file('p_images') as $image)
            {
                $storeName = Store::find(session('store_id'))->name;
                $destinationPath = 'products/'.$storeName;
                $filename = session('store_id').'_'.rand(1, 10000).'_'.$image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                array_push($names, $filename);
            } 
            $images = $names;

            if(count($images) < 4)
            {
                return Redirect::route('create-product')->with('error', "You must upload at least four images");
            }
        }
        else
            $images = ["default.png"];

        
        $product = new Product();
        $product->name = $request->p_name;
        //adding brand to database for future use of the shop
        $product->brand_name = $request->brand_name;
        $brand = Brand::updateOrCreate
        ([
            'name' => $request->brand_name, 
            'store_id' => session('store_id'),
            'status' => '1'
        ]);
        $brand->save();

        $product->model = $request->p_model;
        if($request->seller_id != '')
        {
            $product->seller_id = $request->seller_id;
        }
        else
        {
            $product->seller_name = $request->s_name;
            $product->seller_phone = $request->s_phone;

            //saving seller to database for future use
            $seller = Seller::updateOrCreate(
                [
                    'name' => $request->s_name,
                    'phone' => $request->s_phone,
                    'store_id' => session('store_id'),
                    'status' => '1'
                ]
            );
            $seller->save();
        }
        $product->customer_name = 'none';
        $product->sold_at = 0;
        $product->price = $request->price;
        $product->sell_price = $request->sell_price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->images = $images;
        $product->store_id = session('store_id');
        $product->status = 1;


        if($product->save())
            return Redirect::route('list-product')->with('success', $request->p_name.' Added!');
        else
            return Redirect::route('create-product')->with('error', $request->p_name.' Not Added!');
    }


    //this function render a component to edit a specific product
    public function edit($id)
    {
        return Inertia::render('Admin/Products/edit', [
            'product' => Product::find($id), 
            'brands' => Brand::where('store_id', session('store_id'))->get(), 
            'sellers' => Seller::where('store_id', session('store_id'))->get(), 
            'customers' => Customer::where('store_id', session('store_id'))->get(),
        ]);
    }


    //this function update the product
    public function update(ProductRequest $request)
    {

        $product = Product::find($request->p_id);

        //product images
        if($request->hasFile('p_images')) 
        {

            $names = [];
            foreach($request->file('p_images') as $image)
            {
                $storeName = Store::find(session('store_id'))->name;
                $destinationPath = 'products/'.$storeName;
                $filename = session('store_id').'_'.rand(1, 10000).'_'.$image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                array_push($names, $filename);
            } 
            $images = $names;
            
            if(count($images) < 4)
            {
                return Redirect::back()->with('error', "You must upload at least four images");
            }

            $product->images = $images;
        }

        
        $product->name = $request->p_name;
        $product->brand_name = $request->brand_name;
        $product->model = $request->p_model;

        if($request->seller_id != '')
        {
            $product->seller_id = $request->seller_id;
        }
        else
        {
            $product->seller_name = $request->s_name;
            $product->seller_phone = $request->s_phone;

            //saving seller to database for future use
            $seller = Seller::updateOrCreate(
                [
                    'name' => $request->s_name,
                    'phone' => $request->s_phone,
                    'store_id' => session('store_id'),
                    'status' => '1'
                ]
            );
            $seller->save();
        }

        $product->price = $request->price;
        $product->sell_price = $request->sell_price;
        $product->quantity = $request->quantity;
        // $product->status = 1;
        $product->store_id = session('store_id');
        $product->description = $request->description;

        

        if($product->update())
            return Redirect::route('list-product')->with('success', $request->p_name.' Updated!');
        else
            return Redirect::route('list-product')->with('error', $request->p_name.'Not Updated!');
    }


    //this function delete the product
    public function delete($id)
    {
        if(Product::find($id)->delete())
            return Redirect::route('list-product')->with('success', 'Record Deleted!');
        else
            return Redirect::route('list-product')->with('error', 'Recored Not Deleted!');
    }



    //this function show details of the product
    public function detail($id)
    {
        return Inertia::render('Admin/Products/detail', ['product' => Product::with('brand', 'seller', 'customer')->find($id)]);
    }

    //this function show the invoice of the product
    public function invoice($id)
    {
        return Inertia::render('Admin/Products/invoice', ['product' => SoldProduct::find($id), 'store' => Store::find(session('store_id'))]);
    }


    //this function show form for the selling a product
    public function sell($id)
    {
        return Inertia::render('Admin/Products/sell', ['product' => Product::with('brand', 'seller')->find($id), 'customers' => Customer::where('store_id', session('store_id'))->get()]);
    }

    //this function show all the sold products
    public function sold_products()
    {
        return Inertia::render('Admin/Products/sold_products', ['products' => SoldProduct::where('store_id', session('store_id'))->latest()->paginate(10)]);
    }


    //this function sell the product
    public function sold(Request $request)
    {

        $product = Product::find($request->p_id);
        $product->sold_at = ($request->sold_at == '' ? 0 : $request->sold_at);

        if($request->customer_id != '')
            $product->customer_id = $request->customer_id;
        else
        {
            $product->customer_name = $request->c_name;
            $product->customer_phone = $request->c_phone;

            //saving customer to database for future use
            $customer = Customer::updateOrCreate(
                [
                    'name' => $request->c_name,
                    'phone' => $request->c_phone,
                    'store_id' => session('store_id'),
                    'status' => '1'
                ]
            );
            $customer->save();
        }

        if($product->quantity == $request->sold_quantity)
            $product->status = 0;
        else
            $product->status = 1;


        if($request->sold_quantity <= 0)
            return Redirect::back()->with('error', 'Product Quantity must be greater than zero!');

        elseif($request->sold_quantity > $product->quantity)
            return Redirect::back()->with('error', 'You don not have enough products in your stock!');

        else
        {

            $product->sold_quantity = $request->sold_quantity;
            $product->quantity = $product->quantity - $request->sold_quantity;
        }

        
        //storing the record in sold produts table
        $soldProduct = new SoldProduct;
        $soldProduct->name = $product->name;
        $soldProduct->brand = $product->brand_name;
        $soldProduct->model = $product->model;
        $soldProduct->description = $product->description;
        $soldProduct->store_id = session('store_id');
        $soldProduct->product_id = $product->id;
        $soldProduct->return_status = 0;
        // $soldProduct->product_id = $request->p_id;
        if($request->customer_id != '')
            $soldProduct->customer = $product->customer->name." | ".$product->customer->phone." | ".$product->customer->address." | ".$product->customer->cnic;
        else
            $soldProduct->customer = $request->c_name." | ".$request->c_phone;
        $soldProduct->sold_at = $product->sold_at;
        $soldProduct->sold_quantity = $product->sold_quantity;

        //calculating profit
        $purchasePrice = $product->price * $product->sold_quantity;
        $sellPrice = $product->sold_at * $product->sold_quantity;

        $profit = $sellPrice - $purchasePrice;

        $soldProduct->profit = $profit;

        $soldProduct->save();

        if($product->save())
            return Redirect::route('list-product')->with('success', 'Product Sold!');
        else
            return Redirect::back()->with('error', 'Product Not Sold!');
    }


    //this function return the sold product
    public function return(Request $request, $id)
    {
        $product = Product::find($id);
        $sold_product = SoldProduct::where('product_id', $id)->where('return_status', '0')->first();
        if($request->quantity <= $product->sold_quantity)
        {
       
            //calculating profit
            $remained_products = $sold_product->sold_quantity - $request->quantity;
            $sold_product->profit = ($sold_product->profit * $remained_products) / $sold_product->sold_quantity;

            //changing status
            if($request->quantity == $product->sold_quantity)
            {
                $sold_product->return_status = 1;
            }
            else
            {
                $sold_product->return_status = 0;
            }

            $product->status = 1;
            $product->sold_quantity = $sold_product->sold_quantity - $request->quantity;
            $sold_product->sold_quantity = $sold_product->sold_quantity - $request->quantity;
            $product->quantity = $product->quantity + $request->quantity;

            $sold_product->returned_quantity = $request->quantity;
            


            $sold_product->returned_at = now()->format('d-M-Y');
            $sold_product->save();

            if($product->save())
                return Redirect::route('list-product')->with('success', 'Product Returned!');
            else
                return Redirect::route('list-product')->with('error', 'Product Not Returned!');
        }
        else
        {
            return Redirect::route('list-product')->with('error', 'Returning products quantity is more than sold quantity!');
        }
    }



    /**
     * 
     * Products CRUD Operation ends here
     */
}
