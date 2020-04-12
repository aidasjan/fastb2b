@extends('layouts.app')

@section('content')

<div class='container text-center'>

    <div class='row py-5'>
        <div class='col'>
            <h1 class='text-uppercase'>My discounts</h1>
        </div>
    </div>

    <div class='row py-3'>
        <div class='col'>

                <table class='table_main'>
                    <tr><th></th><th>Category</th><th>Product group</th><th>Discount</th></tr>
                    <?php $counter = 1; ?>
                    @foreach ($discounts as $discount)
                        <tr>
                            <td>{{$counter++}}.</td>
                            <td>{{$discount->subcategory->category->name}}</td>
                            <td><a href="{{url('/subcategories'.'/'.$discount->subcategory_id)}}">{{$discount->subcategory->name}}</td>
                            <td>{{$discount->discount}}%</td>
                        </tr>
                    @endforeach
                </table>

        </div>
    </div>
</div>
@endsection