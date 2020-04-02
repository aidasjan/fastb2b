@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row py-5'>
        <div class='col container_grey py-5'>
            <h1>ADD SUBCATEGORY</h1>
            <form action='{{ action('SubcategoriesController@store')}}' method='POST'>
                <div class='form-group col-md-6 offset-md-3 align-self-center'>
                    <label>Subategory name</label>
                    <input type='text' value='' name='subcateg_name' class='form-control'>
                </div>
                <input type='hidden' value='{{$categoryID}}' name='subcateg_category'>
                {{csrf_field()}}
                <button type='submit' class='btn btn-primary'>SAVE SUBCATEGORY</button>
            </form>
        </div>
    </div>

</div>
@endsection