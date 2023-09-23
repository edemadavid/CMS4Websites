@extends('layouts.auth-layout')

@section('contents')
<form class="login100-form" method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <span class="login100-form-title p-b-43">
        Reset Password
    </span>


    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
        <input class="input100" type="text" name="email" value="">
        <span class="focus-input100"></span>
        <span class="label-input100">Email</span>
    </div>

    @error('email')
    <span class="alert-validate bg3">
        <strong>is-invalid</strong>
    </span>
    @enderror
    @error('password')
    <span class="alert-validate bg3">
        <strong>is-invalid</strong>
    </span>
    @enderror

    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" name="password">
        <span class="focus-input100"></span>
        <span class="label-input100">Password</span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Confirm your password">
        <input class="input100" type="password" name="password_confirmation">
        <span class="focus-input100"></span>
        <span class="label-input100">Confirm Password</span>
    </div>

    <div class="flex-sb-m w-full p-t-3 p-b-32">
        <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="label-checkbox100" for="ckb1">
                Remember me
            </label>
        </div>
    </div>


    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
           Reset Password
        </button>
    </div>

</form>
@endsection
