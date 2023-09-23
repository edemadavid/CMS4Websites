@extends('layouts.auth-layout')

@section('contents')
<form class="login100-form validate-form" method="POST" action="{{ route('password.confirm') }}">
    @csrf
    <span class="login100-form-title p-b-43">
        Confirm Password
    </span>


    @error('password')
    <span class="alert-validate bg3">
        <strong>{{ $message }}</strong>
    </span>
    @enderror


    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" name="password">
        <span class="focus-input100"></span>
        <span class="label-input100">Password</span>
    </div>


    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            Confirm Password
        </button>
    </div>

</form>
@endsection
