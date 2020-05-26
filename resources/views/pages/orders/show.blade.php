@extends('layouts.app')

@section('content')

<div class='container text-center'>

    <div class='row py-5'>
        <div class='col'>
            <h1 class='text-uppercase'>ORDER {{$order->id}} - {{$user->name}}</h1>
        </div>
    </div>

    <div class='row py-3'>
        <div class='col'>

            <table class='table table-responsive-md table_main'>
                <tr><th></th><th>Code</th><th>Name</th><th>Quantity</th><th>Unit</th><th>Price</th><th>Discount</th><th>Final</th><th>Total</th></tr>
                <?php $counter = 1; ?>
                @foreach ($order_products as $order_product)
                    <tr>
                        <td>{{$counter++}}.</td>
                        <td>{{$order_product->code}}</td>
                        <td>{{$order_product->name}}</td>
                        <td>{{$order_product->quantity}}</td>
                        <td>{{$order_product->unit}}</td>
                        <td>{{number_format($order_product->price, 2, '.', '').' '.$order_product->currency}}</td>
                        <td>{{number_format($order_product->discount, 2, '.', '')}}%</td>
                        <td>{{number_format($order_product->price_discount, 2, '.', '').' '.$order_product->currency}}</td>
                        <td>{{number_format($order_product->total_price, 2, '.', '').' '.$order_product->currency}}</td>
                    </tr>
                @endforeach
                <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>Total:</th>
                    <th>
                        {{number_format($total_order_price, 2, '.', '')}} EUR
                    </th>
                </tr>
            </table>
            
        </div>
    </div>

    @if (!Auth::guest() && Auth::user()->isClient() && $order->status === 0)
        <div class='my-3'>
            <form action='{{ action('OrdersController@update', $order->id)}}' method='POST'>
                <input type='hidden' name='_method' value='PUT'>
                {{csrf_field()}}
                <button type='submit' class='btn btn-primary text-uppercase'>Submit</button>
            </form>
        </div>
        <div class='my-3'>
            <a href={{url('/orders'.'/'.$order->id.'/edit')}} class='link_main text-uppercase'>Edit</a>
        </div>
    @endif

    @if ((!Auth::guest() && Auth::user()->isClient() && $order->status === 0) || (!Auth::guest() && Auth::user()->isAdmin()))
        <div class='my-3'>
            <form action='{{ action('OrdersController@update', $order->id)}}' method='POST'>
                <input type='hidden' name='_method' value='DELETE'>
                {{csrf_field()}}
                <button type='submit' class='btn btn-link link_red text-uppercase' href='#'>Discard</button>
            </form>
        </div>
    @endif

</div>
@endsection