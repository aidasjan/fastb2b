<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class OrderProduct extends Model
{
    protected $table = 'order_products';
    public $primaryKey = 'id';
    public $timeStamps = true;

    public function order(){
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function getCodeAttribute($value){
        if($this->order->status == 0){
            return $this->getProduct()->code;
        }
        else return $value;
    }
    public function getNameAttribute($value){
        if($this->order->status == 0){
            return $this->getProduct()->name;
        }
        else return $value;
    }
    public function getPriceAttribute($value){
        if($this->order->status == 0){
            return $this->getProduct()->price;
        }
        else return $value;
    }
    public function getCurrencyAttribute($value){
        if($this->order->status == 0){
            return $this->getProduct()->currency;
        }
        else return $value;
    }
    public function getUnitAttribute($value){
        if($this->order->status == 0){
            return $this->getProduct()->unit;
        }
        else return $value;
    }

    public function getProduct(){
        $order_product = $this;
        $product = Product::find($order_product->product_id);
        if($product === null) return null;
        return $product;
    }
}
