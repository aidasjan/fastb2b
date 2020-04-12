<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function subcategory(){
        return $this->belongsTo('App\Subcategory', 'subcategory_id');
    }
    public function product_files(){
        return $this->hasMany('App\ProductFile', 'product_id');
    }
    public function related_products(){
        return $this->hasMany('App\RelatedProduct', 'product_id');
    }
    
    public function getDiscount($user){
        if($user === null) return null;
        $product = $this;
        $subcategory = $product->subcategory;
        $discount = $user->getDiscount($subcategory);
        return $discount;
    }

    public function getPriceWithDiscount($user){
        if($user === null) return null;
        $product = $this;
        $discount = $product->getDiscount($user);
        return $product->price * (1 - $discount/100);
    }
}