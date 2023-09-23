@extends('layouts.auth-layout')

@section('contents')

@if (session('status'))
<span class="alert-validate bg3">
    <strong>{{ session('status') }}</strong>
</span>
@endif

<form class="login100-form" method="POST" action="{{ route('password.email') }}">
    @csrf
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
        <strong>{{ $message }}</strong>
    </span>
    @enderror


    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            Send Password Resend Link
        </button>
    </div>

</form>

@endsection
