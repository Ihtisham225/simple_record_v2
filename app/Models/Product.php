<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';

    //for saving array of images
    protected $casts = ['images' => 'array'];

    //Many to many relation with brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


    //one to one relation with seller
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }


    //one to one relation with customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }


    //one product belong to one store
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
