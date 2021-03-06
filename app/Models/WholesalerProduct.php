<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class WholesalerProduct extends Model
{
    protected $table = 'wholesaler_products';
    protected $fillable = ['batch_number', 'price', 'expiry_date', 'expiry_status','wholesaler_id','products_id', 'type', 'status'];


    // public $appends = [
    //     'category'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


   public function products()
   {
        return $this->belongsToMany(Product::class, 'wholesaler_products', 'id','products_id');
   }

    public function order_items()
    {
        return $this->hasMany(PurchaseOrderItems::class);
    }


    public function getCategoryAttribute()
    {
        return $this->products->category;
    }

    public function product_cat()
    {
        $product_cat = Product::find($this->products_id)->category->pluck();
        return $product_cat;
    }

    public function formattedPrice()
    {
        $price = number_format($this->price, 2);
        return $price;
    }



}
