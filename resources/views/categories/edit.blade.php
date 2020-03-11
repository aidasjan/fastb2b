@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row py-5'>
        <div class='col container_grey py-5'>
            <h1>EDIT {{$category->name}}</h1>
            <form action='{{ action('CategoriesController@update', $category->id)}}' method='POST'>
                <div class='form-group col-md-6 offset-md-3 align-self-center'>
                    <label>Category name EN</label>
                    <input type='text' value="{{$category->getOriginal('name')}}" name='categ_name' class='form-control'>
                </div>
                <input type='hidden' name='_method' value='PUT'>
                {{csrf_field()}}
                <button type='submit' class='btn btn-primary'>SAVE CATEGORY</button>
            </form>
        </div>
    </div>
    <div class='row'>
        <div class='col'>
            <form action='{{ action('CategoriesController@update', $category->id)}}' method='POST'>
                <input type='hidden' name='_method' value='DELETE'>
                {{csrf_field()}}
                <button type='submit' class='btn btn-link link_red' href='#'>DELETE CATEGORY</button>
                <br><small class='text_red'>Subcategories and products inside will be deleted as well</small>
            </form>
        </div>
    </div>

</div>
@endsection