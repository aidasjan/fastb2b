<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderProductsController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->isClient()){

            // Get and validate session
            if(!(session()->has('current_order'))) abort(404);
            $orderID = session('current_order');
            $order = Order::find($orderID);
            if($order === null || $order->user_id !== auth()->user()->id) abort(404);
            
            // Set products to order
            $inputs = $request->all();
            foreach($inputs as $key=>$value){

                // Validate inputs
                $product = Product::find($key);
                if($product !== null){

                    if(!(is_numeric($value) || $value=='')) abort(404); // If value is not valid
                    
                    // If product is already in order
                    if($order->order_products->where('product_id', $key)->first() !== null){
                        $order_product = $order->order_products->where('product_id', $key)->first();
                        if($value > 0) {
                            $order_product->quantity = $value;
                            $order_product->save();
                        }
                        else {
                            $order_product->delete();
                        }
                    }
                    // If product is new
                    else {
                        if($value > 0) {
                            $order_product = new OrderProduct;
                            $order_product->product_id = $key;
                            $order_product->quantity = $value;
                            $order_product->order_id = $order->id;
                            $order_product->save();
                        }
                    }
                }
                
            }

            return redirect('/');
            
        }
        else abort(404);
    }

}
