@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row py-5'>
        <div class='col'>
            <h5>{{auth()->user()->name}} | {{auth()->user()->email}}</h5>
            <h1>ADMIN DASHBOARD</h1>
        </div>
    </div>

    <div class='row py-3'>
        <div class='col py-4 mx-3 shadow container_white'>
            <div class='row'>
                <div class='col text-left'>
                    <h3>Submitted Orders</h3>
                    <span>Orders that have been recently submitted by clients</span>
                </div>
                <div class='col text-right'>
                    <a class='btn btn-primary' href="{{url('/orders/status/1')}}">VIEW ALL</a>
                </div>
            </div>

            <div class='row py-3'>
                <div class='col'>
                    @if(count($submitted_orders) > 0)
                    <table class='table table_main'>
                        <?php $counter = 1 ?>
                        <tr><th></th><th>ORDER</th><th>CLIENT</th><th>DATE</th></tr>
                        @foreach ($submitted_orders as $order)
                            <tr>
                                <td>{{$counter++}}.</td>
                                <td><a href="{{url('/orders'.'/'.$order->id)}}">ORDER {{$order->id}}</td>
                                <td>{{$order->client->name}}</td>
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

    <div class='row'>
        <div class='col-md py-4 mx-3 my-3 shadow container_white'>
            <h3>Add New Client</h3>
            <div class='pb-3'><span>Add client and generate a password</span></div>
            <a href="{{url('/register')}}" class='btn btn-primary'>NEW CLIENT</a>
        </div>

        <div class='col-md py-4 mx-3 my-3 shadow container_white'>
            <h3>Users & Discounts</h3>
            <div class='pb-3'><span>Edit users, reset passwords, manage their personal discounts</span></div>
            <a href="{{url('/users')}}" class='btn btn-primary'>MANAGE USERS</a>
        </div>
    </div>

</div>
@endsection