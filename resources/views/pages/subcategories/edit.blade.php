@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row py-5'>
        <div class='col container_grey py-5'>
            <h1>EDIT {{$subcategory->name}}</h1>
            <form action='{{ action('SubcategoriesController@update', $subcategory->id) }}' method='POST'>
                <div class='form-group col-md-6 offset-md-3 align-self-center'>
                    <label>Subategory name</label>
                    <input type='text' value="{{$subcategory->getOriginal('name')}}" name='subcateg_name' class='form-control'>
                </div>
                <input type='hidden' value='{{$subcategory->category_id}}' name='subcateg_category'>
                <input type='hidden' name='_method' value='PUT'>
                {{csrf_field()}}
                <button type='submit' class='btn btn-primary'>SAVE SUBCATEGORY</button>
            </form>
        </div>
    </div>

    <div class='row'>
        <div class='col'>
            <form action='{{ action('SubcategoriesController@update', $subcategory->id)}}' method='POST'>
                <input type='hidden' name='_method' value='DELETE'>
                {{csrf_field()}}
                <button type='submit' class='btn btn-link link_red' href='#'>DELETE SUBCATEGORY</button>
                <br><small class='text_red'>Products inside will be deleted as well</small>
            </form>
        </div>
    </div>

</div>
@endsection