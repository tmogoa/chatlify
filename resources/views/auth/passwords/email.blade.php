@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100 py-4 container-wrap">
        <div class="card shadow">
            <div class="card-body">
                <div class="w-100 d-flex flex-column align-items-center p-4">
                    <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="90px">
                    <h2 class="logo-text text-primary mt-2">CHATLIFY</h2>
                    <p>Chat your day away</p>
                </div>
                <div class="text-center mb-3 grey-font">Reset your password</div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
        
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
        
                    <div class="mb-3">
                        <label for="email" class="form-label grey-font">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="border w-100 rounded-pill px-3 py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <button type="submit" class="btn btn-primary btn-block mb-3">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
