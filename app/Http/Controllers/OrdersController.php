<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isClient()){
            $orders = Order::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
            return view('pages.orders.index') -> with('orders', $orders);
        }
        else if(auth()->user()->isAdmin()){
            $orders = Order::orderBy('updated_at', 'desc')->get();
            foreach($orders as $order){
                // Attach client to every order
                if($order->getClient() === null) abort(404);
                $order->client = $order->getClient();
            }
            return view('pages.orders.index') -> with('orders', $orders);
        }
        else abort(404);
    }

    public function indexByStatus($status){
        if(auth()->user()->isClient()){
            $orders = Order::where('user_id', auth()->user()->id)->where('status', $status)->orderBy('updated_at', 'desc')->get();
            return view('pages.orders.index') -> with('orders', $orders);
        }
        else if(auth()->user()->isAdmin()){
            $orders = Order::where('status', $status)->orderBy('updated_at', 'desc')->get();
            foreach($orders as $order){
                // Attach client to every order
                if($order->getClient() === null) abort(404);
                $order->client = $order->getClient();
            }
            return view('pages.orders.index') -> with('orders', $orders);
        }
        else abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->isClient()){
            // Create new order
            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->status = 0;
            $order->save();

            // Set session and redirect
            session(['current_order' => $order->id]);
            return redirect('/');
        }
        else abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if($order === null) abort(404);
        
        if((auth()->user()->isClient() && $order->user_id === auth()->user()->id) || auth()->user()->isAdmin()) {

            // Get user
            $user = User::find($order->user_id);
            if($user === null || !$user->isClient()) abort(404);

            $data = array(
                'order_products' => $order->order_products,
                'order' => $order,
                'user' => $user
            );
            
            foreach ($data['order_products'] as $order_product){

                if($order_product->getProduct() === null || $order_product->getTotalPrice($user) === null) abort(404);

                // Get discount
                $order_product->discount = $order_product->getDiscount($user);
                $order_product->price_discount = $order_product->getPriceWithDiscount($user);
                $order_product->total_price = $order_product->getTotalPrice($user);
            }

            $data['total_order_price'] = $order->getTotalOrderPrice($user);

            return view('pages.orders.show')->with($data);
            
        }
        else abort(404);
    }

    /**
     * Edit the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->isClient()){
            session(['current_order' => $id]);
            return redirect('/');
        }
    }

    /**
     * Cancel order by forgetting session
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel(){
        if(auth()->user()->isClient()){
            session()->forget('current_order');
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->isClient()){
            $order = Order::find($id);
            if($order === null || $order->user_id !== auth()->user()->id) abort(404);

            // Client submits order
            if($order->status == 0){ 

                foreach($order->order_products as $order_product){
                    // Write info for every product
                    $product = $order_product->getProduct();
                    if($product === null) abort(404);
                    $order_product->code = $product->code;
                    $order_product->name = $product->name;
                    $order_product->price = $product->price;
                    $order_product->currency = $product->currency;
                    $order_product->unit = $product->unit;
                    $order_product->discount = $product->getDiscount(auth()->user());
                    $order_product->save();
                }

                $order->status = 1;
                $order->save();
                session()->forget('current_order');
                
            }

            return redirect('/orders/status/1')->with('top_notfication_success', __('notifications.order_confirmation', ['order'=>$order->id, 'email'=>auth()->user()->email]));
        }
        else abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if($order === null) abort(404);

        if((auth()->user()->isClient() && $order->user_id === auth()->user()->id && $order->status === 0) || auth()->user()->isAdmin()){
            foreach($order->order_products as $order_product){
                $order_product->delete();
            }
            if(session('current_order') == $order->id) session()->forget('current_order');
            $order->delete();
            
            return redirect('/dashboard');
        }
        else abort(404);
    }
}
