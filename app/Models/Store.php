<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'stores';

    //one store can have many products
    public function product()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    //one store can have many brands
    public function brand()
    {
        return $this->hasMany(Brand::class, 'store_id');
    }

    //one store can have many sellers
    public function seller()
    {
        return $this->hasMany(Seller::class, 'store_id');
    }

    //one store can have many customers
    public function customer()
    {
        return $this->hasMany(Customer::class, 'store_id');
    }


    //one store can have one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
