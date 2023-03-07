<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Facade\FlareClient\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    
    return Redirect::route('login' 
    // [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]
);
});

Route::get('/login', function(){
    return Inertia::render('Auth/Login');
})->name('login');

Route::get('/', [DashboardController::class, 'all_stores']);

// Route::get('register', function() {
//     return Redirect::route('login');
// });


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Redirect::route('list-product'); //old: Inertia::render('dashboard')
})->name('dashboard');




/**
 * 
 * Custom Routes
*/


//Select a store
Route::get('/select-store',[DashboardController::class, 'selectStore']);

//Specific dashboard for specific store
Route::get('/dashboard/{id}', [DashboardController::class, 'dashboard']);

//shwoing products of specific store to all users
Route::get('/products/{id}', [DashboardController::class, 'products']);

//shwoing product specs
Route::get('/product-specs/{id}', [DashboardController::class, 'productSpecs']);

/**
 * 
 * Users Routes Starts here
 */
Route::get('/list', [UserController::class, 'list'])->name('list-user')->middleware('auth');
Route::get('/create-user', [UserController::class, 'create'])->name('create-user');
Route::post('/save-user', [UserController::class, 'save'])->name('save-user');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user')->middleware('auth');
Route::post('/update-user', [UserController::class, 'update'])->name('update-user')->middleware('auth');
Route::get('/user-detail/{id}', [UserController::class, 'detail'])->name('user-detail')->middleware('auth');
Route::delete('/delete-user/{id}', [UserController::class, 'delete'])->name('delete-user')->middleware('auth');
////////////////////////////// END OF USER ROUTES //////////////////////////////////////////////////////////




/**
 * 
 * Stores Routes Starts here
 */
Route::get('/list-store', [StoreController::class, 'list'])->name('list-store')->middleware('auth');
Route::get('/create-store', [StoreController::class, 'create'])->name('create-store')->middleware('auth');
Route::post('/save-store', [StoreController::class, 'save'])->name('save-store')->middleware('auth');
Route::get('/edit-store/{id}', [StoreController::class, 'edit'])->name('edit-store')->middleware('auth');
Route::post('/update-store', [StoreController::class, 'update'])->name('update-store')->middleware('auth');
Route::get('/store-detail/{id}', [StoreController::class, 'detail'])->name('store-detail')->middleware('auth');
Route::delete('/delete-store/{id}', [StoreController::class, 'delete'])->name('delete-store')->middleware('auth');
////////////////////////////// END OF STORE ROUTES //////////////////////////////////////////////////////////




/**
 * 
 * Products Routes Starts here
 */
Route::get('/list', [ProductController::class, 'list'])->name('list-product')->middleware('auth');
Route::get('/create-product', [ProductController::class, 'create'])->name('create-product')->middleware('auth');
Route::post('/save-product', [ProductController::class, 'save'])->name('save-product')->middleware('auth');
Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product')->middleware('auth');
Route::post('/update-product', [ProductController::class, 'update'])->name('update-product')->middleware('auth');
Route::get('/product-detail/{id}', [ProductController::class, 'detail'])->name('product-detail')->middleware('auth');
Route::delete('/delete-product/{id}', [ProductController::class, 'delete'])->name('delete-product')->middleware('auth');
Route::get('/sell-product/{id}', [ProductController::class, 'sell'])->name('sell-product')->middleware('auth');
Route::post('/sold-product', [ProductController::class, 'sold'])->name('sold-product')->middleware('auth');
Route::post('/return-product/{id}', [ProductController::class, 'return'])->name('return-product')->middleware('auth');
Route::get('/invoice-product/{id}', [ProductController::class, 'invoice'])->name('invoice-product')->middleware('auth');
Route::get('/sold-products', [ProductController::class, 'sold_products'])->name('sold-products')->middleware('auth');

////////////////////////////// END OF PRODUCT ROUTES //////////////////////////////////////////////////////////




/**
 * 
 * Brands Routes Starts here
 */
Route::get('/list-brand', [BrandController::class, 'list'])->name('list-brand')->middleware('auth');
Route::get('/create-brand', [BrandController::class, 'create'])->name('create-brand')->middleware('auth');
Route::post('/save-brand', [BrandController::class, 'save'])->name('save-brand')->middleware('auth');
Route::get('/edit-brand/{id}', [BrandController::class, 'edit'])->name('edit-brand')->middleware('auth');
Route::post('/update-brand', [BrandController::class, 'update'])->name('update-brand')->middleware('auth');
Route::delete('/delete-brand/{id}', [BrandController::class, 'delete'])->name('delete-brand')->middleware('auth');

////////////////////////////// END OF BRAND ROUTES //////////////////////////////////////////////////////////




/**
 * 
 * Sellers Routes Starts here
 */
Route::get('/list-seller', [SellerController::class, 'list'])->name('list-seller')->middleware('auth');
Route::get('/create-seller', [SellerController::class, 'create'])->name('create-seller')->middleware('auth');
Route::post('/save-seller', [SellerController::class, 'save'])->name('save-seller')->middleware('auth');
Route::get('/edit-seller/{id}', [SellerController::class, 'edit'])->name('edit-seller')->middleware('auth');
Route::post('/update-seller', [SellerController::class, 'update'])->name('update-seller')->middleware('auth');
Route::get('/seller-detail/{id}', [SellerController::class, 'detail'])->name('seller-detail')->middleware('auth');
Route::delete('/delete-seller/{id}', [SellerController::class, 'delete'])->name('delete-seller')->middleware('auth');

////////////////////////////// END OF SELLER ROUTES //////////////////////////////////////////////////////////




/**
 * 
 * Customer Routes Starts here
 */
Route::get('/list-customer', [CustomerController::class, 'list'])->name('list-customer')->middleware('auth');
Route::get('/create-customer', [CustomerController::class, 'create'])->name('create-customer')->middleware('auth');
Route::post('/save-customer', [CustomerController::class, 'save'])->name('save-customer')->middleware('auth');
Route::get('/edit-customer/{id}', [CustomerController::class, 'edit'])->name('edit-customer')->middleware('auth');
Route::post('/update-customer', [CustomerController::class, 'update'])->name('update-customer')->middleware('auth');
Route::get('/customer-detail/{id}', [CustomerController::class, 'detail'])->name('customer-detail')->middleware('auth');
Route::delete('/delete-customer/{id}', [CustomerController::class, 'delete'])->name('delete-customer')->middleware('auth');

////////////////////////////// END OF CUSTOMER ROUTES //////////////////////////////////////////////////////////




/**
 * 
 * Expenses Routes Starts here
 */
Route::get('/list-expense', [ExpenseController::class, 'list'])->name('list-expense')->middleware('auth');
Route::get('/create-expense', [ExpenseController::class, 'create'])->name('create-expense')->middleware('auth');
Route::post('/save-expense', [ExpenseController::class, 'save'])->name('save-expense')->middleware('auth');
Route::get('/edit-expense/{id}', [ExpenseController::class, 'edit'])->name('edit-expense')->middleware('auth');
Route::post('/update-expense', [ExpenseController::class, 'update'])->name('update-expense')->middleware('auth');
Route::delete('/delete-expense/{id}', [ExpenseController::class, 'delete'])->name('delete-expense')->middleware('auth');

////////////////////////////// END OF BRAND ROUTES //////////////////////////////////////////////////////////


/******************************************* END OF CUSTOM ROUTES *********************************************************************************** */


