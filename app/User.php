<?php

namespace App;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\UserDetails;
use App\Models\WholesalerProduct;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    CONST IS_ADMIN = 'admin';
    CONST IS_WHOLESALER = 'wholesaler';
    CONST IS_RETAILER = 'retailer';
    CONST IS_APPROVE = 'approve';
    CONST IS_CANCEL = 'cancel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'phone', 'type', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $appends = [
        'product_category'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $this->firstname.' '.$this->lastname;
    }


    public function scopeIsWholeSaler($query, $wholesalerId = null)
    {
        return $query->where('type', 'wholesaler');
    }

    public function scopeIsRetailer($query)
    {
        return $query->where('type', 'retailer');
    }


    public function wholesaler_products()
    {
        return $this->hasMany(WholesalerProduct::class, 'wholesaler_id');
    }


    public function product_category()
    {
        $prod_ids = collect($this->wholesaler_products)->pluck('products_id');
        $productCatIds = Product::whereIn('id', $prod_ids)->pluck('product_category_id');
        $prod_ids = $this->returnProductCats($productCatIds);
        return $prod_ids;
    }

    public function returnProductCats($ids = [])
    {
        $cats = ProductCategory::whereIn('id', $ids)->get('name');
        return $cats->implode('name', ', ');
    }

    public function details()
    {
        return $this->hasOne(UserDetails::class,'users_id');    
    }

}
