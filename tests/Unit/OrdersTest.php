<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Order;
use App\User;

class OrdersTest extends TestCase
{
    
    public function testOrderGetStatus()
    {
        $order = new Order;
        $order->status = 1;
        $this->assertEquals("Submitted", $order->getStatus());
        $order->status = 0;
        $this->assertEquals("Placing", $order->getStatus());
        $order->status = 50;
        $this->assertEquals("undefined", $order->getStatus());
    }

    public function testOrderGetClient()
    {
        $this->destroyData();
        $this->setupData();
        $order = Order::find(10000);
        $user = $order->getClient();
        $this->assertEquals("test@test.lt", $user->email);
        $order = Order::find(10001);
        $user = $order->getClient();
        $this->assertEquals(null, $user);
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

        $user = new User;
        $user->id = 5001;
        $user->name = "test2";
        $user->email = "test2@test.lt";
        $user->role = "admin";
        $user->password = "";
        $user->save();

        $order = new Order;
        $order->id = 10001;
        $order->user_id = 5001;
        $order->status = 0;
        $order->save();
    }

    public function destroyData() 
    {
        User::find(5000) ? User::find(5000)->delete() : null;
        Order::find(10000) ? Order::find(10000)->delete() : null;
        User::find(5001) ? User::find(5001)->delete() : null;
        Order::find(10001) ? Order::find(10001)->delete() : null;
    }

}
