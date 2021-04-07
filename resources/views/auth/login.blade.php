@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100 py-4">
        <div class="d-flex flex-column justify-content-center align-items-center border rounded p-5 card shadow">
            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="90px">
            <h2 class="logo-text text-primary mt-2">Chatlify</h2>
            <p>Chat your day away</p>
            <form class="mt-1" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label grey-font">Email address</label>
                    <input type="email" class="border w-100 rounded-pill px-3 py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        aria-describedby="emailHelp" placeholder="Email address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label grey-font">Password</label>
                    <input type="password" class="border w-100 rounded-pill px-3 py-2 @error('password') is-invalid @enderror" id="password" name="password"
                        placeholder="Your password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group d-flex w-100">
                    <div class="w-100">
                        <div class="form-check flex-row justify-content-start w-100">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </form>
            <span class="mt-3">Don't have an account? <a href="{{ route('register')}}">Sign up</a></span>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </div>
@endsection
