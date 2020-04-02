@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row py-5'>
            <div class='col'>
                <h1 style='text-transform: uppercase;'>{{$category->name}}</h1>
            </div>
        </div>

        @if(!Auth::guest() && Auth::user()->isAdmin())
            <div class='row py-2'>
                <div class='col'>
                    <a href="{{url('/subcategories/create/'.$category->id)}}"><div class='btn btn-primary'>ADD SUBCATEGORY</div></a>
                </div>
            </div>
        @endif

        <div class='menu_section_middle'>
            <div class='container'>
                @foreach ($subcategories as $subcategory)
                    <div class='col-md py-2 px-3'>
                        <a href="{{url('subcategories/'.$subcategory->id)}}"><div class='button_big py-2 px-2'><div>{{$subcategory->name}}</div></div></a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection