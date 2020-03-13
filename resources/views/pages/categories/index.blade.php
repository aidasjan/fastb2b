@extends('layouts.app')

@section('content')
<div class='container'>

    <div class='row pt-3 pb-4'>
        <div class='col'>
            <h1 class='text-uppercase'>CATALOG</h1>
        </div>
    </div>

    <hr>
    @if(!Auth::guest() && Auth::user()->isAdmin())
        <div class='row py-3'>
            <div class='col'>
                <a href='{{url("/categories/create")}}'><div class='btn btn-primary'>ADD CATEGORY</div></a>
            </div>
        </div>
    @endif

    <div class='row py-3'>
        <div class='col'>
            <?php $counter=0; ?>
            @foreach ($categories as $category)
                <div class='col-md py-2 px-3'>
                    <a href='categories/{{$category->id}}'><div class='button_big py-2 px-2'><div>{{$category->name}}</div></div></a>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection