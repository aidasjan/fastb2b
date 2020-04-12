@extends('layouts.app')

@section('content')

<div class='container text-center'>

    <div class='row py-5'>
        <div class='col'>
            <h1 style='text-transform: uppercase;'>{{$headline}}</h1>
            @if(!empty($discount) && $discount > 0)<h2 class='text_green'>{{$discount}}% discount</h2><span class='text_green'>for all products</span> @endif
        </div>
    </div>


    @if(!Auth::guest() && Auth::user()->isAdmin() && !empty($subcategory))
        <div class='row pb-2'>
            <div class='col'>
                <a href="{{url('/subcategories'.'/'.$subcategory->id.'/edit')}}" class='link_main'>EDIT SUBCATEGORY</a>
            </div>
        </div>
        <div class='row py-3'>
            <div class='col'>
                <a href="{{url('/products/create/'.$subcategory->id)}}"><div class='btn btn-primary'>ADD PRODUCT</div></a>
            </div>
        </div>
    @endif

    <div class='row py-3'>
        <div class='col'>
            
        @if(count($products) > 0)
                <table class='table table-responsive-md table_main'>
                    <tr><th></th><th>Code</th><th>Name</th><th>Unit</th><th>Currency</th><th>Price</th></tr>
                    <?php $counter = 1 ?>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$counter++}}.</td>
                            <td>{{$product->code}}</td>
                            <td><a href="{{url('/products'.'/'.$product->id)}}">{{$product->name}}</a></td>
                            <td>{{$product->unit}}</td>
                            <td>{{$product->currency}}</td>
                            <td>{{number_format($product->price, 2, '.', '').' '.$product->currency.' / '.$product->unit}}</td>
                        </tr>
                    @endforeach
                </table>
        @else
            <h2 class='pt-5'>No results</h2>
        @endif
        </div>
    </div>
</div>
@endsection