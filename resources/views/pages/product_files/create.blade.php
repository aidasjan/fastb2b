@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row py-5'>
            <div class='col container_grey py-5'>
                <h1>ADD NEW FILE</h1>
                <form action='{{ action('ProductFilesController@store') }}' method='POST' enctype='multipart/form-data'>
                    <div class='form-group col-md-4 offset-md-4 align-self-center'>
                        <label>Name</label>
                        <input type='text' value='' name='prodfile_name' class='form-control'>
                        <small>Will be visible for users. Not required for images.</small>
                    </div>
                    <div class='form-group col-md-6 offset-md-3'>
                        <input type='file' value='' name='prodfile_file'>
                    </div>
                    <input type='hidden' value='{{$productID}}' name='prodfile_productID'>
                    {{csrf_field()}}
                    <button type='submit' class='btn btn-primary'>SAVE FILE</button>
                </form>
            </div>
        </div>
    </div>
@endsection