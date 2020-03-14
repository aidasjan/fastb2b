@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row py-5'>
        <div class='col'>
            <h5>{{auth()->user()->name}} | {{auth()->user()->email}}</h5>
            <h1 class='text-uppercase'>Dashboard</h1>
        </div>
    </div>
    <div class='row py-3'>
        <div class='col py-4 mx-3 container_white shadow'>
            <h3>Make order</h3>
            <span>Click this button and start making an order</span>
            <div>
                <button type='submit' class='btn btn-primary mt-4 mb-3 text-uppercase' href='#'>New order</button>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-md mx-3'>
            <div class='row py-4'>
                <div class='col py-2 container_white shadow'>
                    <div class='row'>
                        <div class='col text-left py-3'>
                            <h3>Unsubmitted orders</h3>
                        </div>
                        <div class='col text-right py-3'>
                            <a class='btn btn-primary text-uppercase' href="{{url('/orders/status/0')}}">All</a>
                        </div>
                    </div>

                    <div class='row py-3'>
                        <div class='col'>
                            @if(count($unsubmitted_orders) > 0)
                            <table class='table table_main'>
                                <?php $counter = 1 ?>
                                <tr><th></th><th>Order</th><th>Date</th></tr>
                                @foreach ($unsubmitted_orders as $order)
                                    <tr>
                                        <td>{{$counter++}}.</td>
                                        <td><a href="{{url('/orders'.'/'.$order->id)}}" class='text-uppercase'>{{$order->id}}</td>
                                        <td>{{$order->updated_at}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @else
                            <h5>No orders</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class='row py-4'>
                <div class='col py-2 container_white shadow'>
                    <div class='row'>
                        <div class='col text-left py-3'>
                            <h3>Submitted orders</h3>
                        </div>
                        <div class='col text-right py-3'>
                            <a class='btn btn-primary text-uppercase' href="{{url('/orders/status/1')}}">All</a>
                        </div>
                    </div>

                    <div class='row py-3'>
                        <div class='col'>
                            @if(count($submitted_orders) > 0)
                            <table class='table table_main'>
                                <?php $counter = 1 ?>
                                <tr><th></th><th>Order</th><th>Date</th></tr>
                                @foreach ($submitted_orders as $order)
                                    <tr>
                                        <td>{{$counter++}}.</td>
                                        <td><a href="{{url('/orders'.'/'.$order->id)}}" class='text-uppercase'>{{$order->id}}</td>
                                        <td>{{$order->updated_at}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @else
                            <h5>No orders</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class='col-md mx-3'>
                
        <div class='row py-4'>
            <div class='col py-2 container_white shadow'>
                <div class='row'>
                    <div class='col text-left py-3'>
                        <h3>Discounts</h3>
                    </div>
                    <div class='col text-right py-3'>
                        <a class='btn btn-primary text-uppercase' href="{{url('/discounts')}}">All</a>
                    </div>
                </div>

                <div class='row py-3'>
                    <div class='col'>
                        @if(count($discounts) > 0)
                        <table class='table table_main'>
                            <?php $counter = 1 ?>
                            <tr><th></th><th>Subcategory</th><th>Value</th></tr>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td>{{$counter++}}.</td>
                                    <td><a href="{{url('/subcategories'.'/'.$discount->subcategory_id)}}">{{$discount->subcategory_name}}</td>
                                    <td>{{$discount->discount}}%</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                        <h5>No discounts</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class='row py-4'>
            <div class='col py-2 shadow container_white'>
                <div class='row py-3'>
                    <div class='col text-left'>
                        <h3>My account</h3>
                    </div>
                </div>

                <div class='row py-1'>
                    <div class='col text-left'>
                        <h5><b>Name: </b>{{auth()->user()->name}}</h5>
                        <h5 class='pb-2'><b>Email: </b>{{auth()->user()->email}}</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
             
@endsection
