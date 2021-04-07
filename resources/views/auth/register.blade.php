@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100 py-2 container-wrap">
        <div class="d-flex flex-column justify-content-center align-items-center border rounded px-5 py-3 bg-white welcome-card flex-grow-1 container-content" style="width: 450px;">
            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="40px">
            <h2 class="logo-text text-primary mt-2">CHATLIFY</h2>
            <p>Chat your day away</p>
            <form class="mt-1" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3 mt-4">
                <label for="username" class="form-label grey-font">Choose a username</label>
                <input type="text" class="border w-100 rounded-pill px-3 py-2 @error('name') is-invalid @enderror" id="username" name="username" value="{{ old('name') }}" required autocomplete="username" placeholder="Choose a username" autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-3">
                <label for="email" class="form-label grey-font">Email address</label>
                <input id="email" type="email" class="border w-100 rounded-pill px-3 py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-3">
                <label for="password" class="form-label grey-font">Password</label>
                <input id="password" type="password" class="border w-100 rounded-pill px-3 py-2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-3">
                <label for="confirm-password" class="form-label grey-font">Confirm Password</label>
                <input id="password-confirm" type="password" class="border w-100 rounded-pill px-3 py-2" name="password_confirmation" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create account</button>
                <div class="smaller-text text-center grey-text mt-1">By creating an account you agree to our Privacy Policy and our Terms and Conditions</div>
            </form>
            <span class="mt-3 small-text"><a href="{{ route('login') }}">Log in</a></span>
        </div>
    </div>
@endsection
