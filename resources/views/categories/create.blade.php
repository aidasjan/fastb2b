@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row py-5'>
        <div class='col container_grey py-5'>
            <h1>ADD CATEGORY</h1>
            <form action='{{ action('CategoriesController@store')}}' method='POST'>
                <div class='form-group col-md-6 offset-md-3 align-self-center'>
                    <label>Category name</label>
                    <input type='text' value='' name='categ_name' class='form-control'>
                </div>
                {{csrf_field()}}
                <button type='submit' class='btn btn-primary'>SAVE CATEGORY</button>
            </form>
        </div>
    </div>

</div>
@endsection