<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class RelatedProduct extends Model
{
    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function getProduct(){
        $related_product = $this;
        return Product::find($related_product->related_product_id);
    }
}