<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sellers';

    public function product()
    {
        return $this->hasOne(Product::class, 'seller_id');
    }


    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

}
