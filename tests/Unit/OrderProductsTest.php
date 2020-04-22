<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Order;
use App\User;
use App\OrderProduct;
use App\Product;

class OrderProductsTest extends TestCase
{

    public function testOrderGetProduct()
    {
        $this->destroyData();
        $this->setupData();
        $order_product = OrderProduct::find(11000);
        $product = $order_product->getProduct();
        $this->assertEquals(100, $product->price);
    }

    public function testOrderGetPriceAttribute()
    {
        $this->destroyData();
        $this->setupData();
        $order_product = OrderProduct::find(11000);
        $this->assertEquals(100, $order_product->price);
    }

    public function setupData() 
    {
        $user = new User;
        $user->id = 5000;
        $user->name = "test";
        $user->email = "test@test.lt";
        $user->role = "client";
        $user->password = "";
        $user->save();

        $order = new Order;
        $order->id = 10000;
        $order->user_id = 5000;
        $order->status = 0;
        $order->save();

        $product = new Product;
        $product->id = 7000;
        $product->name = "Test";
        $product->code = "T01";
        $product->price = 100;
        $product->currency = "EUR";
        $product->unit = "kg";
        $product->subcategory_id = 6000;
        $product->save();

        $order_product = new OrderProduct;
        $order_product->id = 11000;
        $order_product->code = "AAA";
        $order_product->name = "Test";
        $order_product->price = 50;
        $order_product->currency = "EUR";
        $order_product->unit = "kg";
        $order_product->product_id = 7000;
        $order_product->order_id = 10000;
        $order_product->quantity = 10;
        $order_product->discount = 40;
        $order_product->save();
    }

    public function destroyData() 
    {
        User::find(5000) ? User::find(5000)->delete() : null;
        Order::find(10000) ? Order::find(10000)->delete() : null;
        Product::find(7000) ? Product::find(7000)->delete() : null;
        OrderProduct::find(11000) ? OrderProduct::find(11000)->delete() : null;
    }

}
