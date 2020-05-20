<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    protected $table = 'orders';
    public $primaryKey = 'id';
    public $timeStamps = true;

    public function order_products(){
        return $this->hasMany('App\OrderProduct', 'order_id');
    }

    public function getStatus(){
        $order = $this;
        switch($order->status){
            case 0: return 'Placing';
            case 1: return 'Submitted';
            case 2: return 'Confirmed';
            default: return 'undefined';
        }
        
    }

    public function getClient(){
        $order = $this;
        $user = User::find($order->user_id);
        if($user !== null && $user->isClient()) return $user;
    }
    
    public function attachQuantities($products){
        $order = $this;
        if($products === null) return null;
        foreach($products as $product){
            if($order->order_products->where('product_id', $product->id)->first() !== null){
                $order_product = $order->order_products->where('product_id', $product->id)->first();
                $product->quantity = $order_product->quantity;
            }
            else $product->quantity = 0;
        }
        return $products;
    }

}