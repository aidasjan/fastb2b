@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row py-5'>
        <div class='col'>
            <h5>{{auth()->user()->name}} | {{auth()->user()->email}}</h5>
            <h1 class='text-uppercase'>Dashboard</h1>
        </div>
    </div>
</div>
             
@endsection
