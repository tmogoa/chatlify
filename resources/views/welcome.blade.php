@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column w-100 h-100 container-wrap">
        <div class="d-flex justify-content-center align-items-center flex-column rounded-bottom border p-5 bg-white welcome-card flex-grow-1 container-content">
            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="250px">
            <h2 class="logo-text text-primary mt-3" style="font-size: 20px">CHATLIFY</h2>
            <p>Chat your day away</p>
            <a href="/login" class="btn btn-primary btn-block mt-3">Start chatting away</a>
        </div>
        <div class="text-dark d-flex flex-column flex-column-reverse align-items-center w-100">
            <span class="mr-3 mt-5">Photo by <a href="https://unsplash.com/@cristina_gottardi?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText" class="text-white">Cristina Gottardi</a> on <a href="https://unsplash.com/s/photos/chat?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText" class="text-white">Unsplash</a><span/>
        </div>
    </div>
@endsection