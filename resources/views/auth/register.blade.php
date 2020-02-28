@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row py-5'>
        <div class='col'>
            <h1 class='text-uppercase'>New user</h1>
        </div>
    </div>
        
    <div class='row py-3'>
        <div class='col'>
            <form method="POST" action="{{ action('Auth\RegisterController@register') }}">
                @csrf
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Name</label>
                    <div class="col-md-5">
                        <input id="email" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" placeholder="" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                    <div class="col-md-5">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" placeholder="" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-5">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="" name="password" placeholder="" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                    <div class="col-md-5">
                        <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="" name="password_confirmation" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label> 
                        </div>
                    </div>
                </div>
                <div class="row mb-0 pt-3 text-center">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary text-uppercase">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

                    
@endsection
