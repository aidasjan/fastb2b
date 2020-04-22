<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Discount;
use App\User;
use App\Subcategory;
use App\Product;

class DiscountsTest extends TestCase
{
    public function testGetAllDiscounts()
    {
        $this->destroyData();
        $this->setupData();
        $user = User::find(5000);
        $discounts = $user->getAllDiscounts();
        $this->assertEquals(1, count($discounts));
        $this->assertEquals(10, $discounts->first()->discount);
        $this->assertTrue(true);
    }

    public function testGetDiscountBySubcategory()
    {
        $this->destroyData();
        $this->setupData();
        $user = User::find(5000);
        $subcategory = Subcategory::find(6000);
        $discount = $user->getDiscount($subcategory);
        $this->assertEquals(10, $discount);
        $this->assertTrue(true);
    }

    public function testGetProductDiscount()
    {
        $this->destroyData();
        $this->setupData();
        $product = Product::find(7000);
        $user = User::find(5000);
        $price = $product->getDiscount($user);
        $this->assertEquals(10, $price);
        $this->assertTrue(true);
    }

    public function testGetProductPriceWithDiscount()
    {
        $this->destroyData();
        $this->setupData();
        $product = Product::find(7000);
        $user = User::find(5000);
        $price = $product->getPriceWithDiscount($user);
        $this->assertEquals(90, $price);
        $this->assertTrue(true);
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

        $subcategory = new Subcategory;
        $subcategory->id = 6000;
        $subcategory->name = "Test";
        $subcategory->category_id = "1000";
        $subcategory->save();

        $discount = new Discount;
        $discount->id = 10000;
        $discount->user_id = 5000;
        $discount->subcategory_id = 6000;
        $discount->discount = 10;
        $discount->save();

        $product = new Product;
        $product->id = 7000;
        $product->name = "Test";
        $product->code = "T01";
        $product->price = 100;
        $product->currency = "EUR";
        $product->unit = "kg";
        $product->subcategory_id = 6000;
        $product->save();
    }

    public function destroyData() 
    {
        User::find(5000) ? User::find(5000)->delete() : null;
        Subcategory::find(6000) ? Subcategory::find(6000)->delete() : null;
        Discount::find(10000) ? Discount::find(10000)->delete() : null;
        Product::find(7000) ? Product::find(7000)->delete() : null;
    }
}