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

    public function getTotalOrderPrice($user, $currency){
        if ($user === null) return null;
        if ($currency === null) return null;
        $total_price = 0;
        $order = $this;
        foreach($order->order_products as $order_product){
            if($order_product->currency == $currency){
                $total_price += $order_product->getTotalPrice($user);
            }
        }
        return $total_price;
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

}