@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100 py-4 container-wrap">
        <div class="card">
            <div class="card-body">
                <div class="w-100 d-flex flex-column align-items-center p-4">
                    <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="90px">
                    <h2 class="logo-text text-primary mt-2">CHATLIFY</h2>
                    <p>Chat your day away</p>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
        
                    <input type="hidden" name="token" value="{{ $token }}">
        
                    <div class="mb-3">
                        <label for="email" class="form-label grey-font">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="border w-100 rounded-pill px-3 py-2 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
        
                    <div class="mb-3">
                        <label for="password" class="form-label grey-font">{{ __('Password') }}</label>
                        <input id="password" type="password" class="border w-100 rounded-pill px-3 py-2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Choose a password">
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label grey-font">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="border w-100 rounded-pill px-3 py-2" name="password_confirmation" placeholder="Repeat your password" required autocomplete="new-password">
                    </div>
        
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Reset Password') }}
                    </button>
                       
                </form>
            </div>
        </div>
    </div>
@endsection
