@extends('layouts.app')

@section('content')
<br><br>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <img src="{{ asset('auth/images/logo-nagara.png') }}" class="mr-4" alt="">
                <img src="{{ asset('img/logo-blu.png') }}" width="40%" alt="">
                <br><br>
                <h3 class="mb-4 text-center" style="color:white;"><strong>BIOS G2 <br>(Web Service)</strong></h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    @if (session('error'))
                        <div class="alert alert-danger" id="error-message">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf
                        <input type="text" name="satker" value="{{ env('KD_SATKER') }}" hidden>
                        <input type="text" name="key" value="{{ env('KEY_DEV') }}" hidden>
                        <div class="form-group">
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username" required
                                autofocus placeholder="Username">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3" id="login-button">Sign In</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Remember Me
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="#" style="color: #fff">Forgot Password</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check if error message exists
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            // Disable form inputs and button
            var loginForm = document.getElementById('login-form');
            var loginButton = document.getElementById('login-button');
            var inputs = loginForm.querySelectorAll('input');

            loginButton.disabled = true;
            inputs.forEach(function (input) {
                input.disabled = true;
            });
        }
    });
</script>
@endsection
