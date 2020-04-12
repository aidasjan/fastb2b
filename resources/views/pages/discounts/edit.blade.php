@extends('layouts.app')

@section('content')

<div class='container text-center'>

    <div class='row py-5'>
        <div class='col'>
            <h1 style='text-transform: uppercase;'>{{$user->name}} - discounts</h1>
        </div>
    </div>

    <div class='row py-3'>
        <div class='col'>

            <form action="{{action('DiscountsController@store')}}" method='POST'>
                <table class='table_main'>
                    <tr><th></th><th>CATEGORY</th><th>PRODUCT GROUP</th><th>DISCOUNT (%)</th></tr>
                    <?php $counter = 1; ?>
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td>{{$counter++}}.</td>
                            <td>{{$subcategory->category->name}}</td>
                            <td>{{$subcategory->name}}</td>
                            <td><input type='number' min='0' max='100' step='any' onfocus="this.value=''" value='{{$subcategory->discount}}' name='{{$subcategory->id}}' class='form-control'></td>
                        </tr>
                    @endforeach
                    <td></td><td></td><td></td>
                    <td class='text-center'>
                        <input type='hidden' name='dis_user' value='{{$user->id}}'>
                        {{csrf_field()}}
                        <button type='submit' class='btn btn-primary'>SAVE SELECTIONS</button>
                    </td>
                </table>
            </form>

        </div>
    </div>
</div>
@endsection