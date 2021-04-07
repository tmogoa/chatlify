@extends('layouts.app')

@section('content')
    <div class="containers w-100 h-100 m-0 p-0">
        <div class="row w-100 h-100 m-0">
            <div class="col-4 bg-white p-1 m-0">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center my-2 mx-3">
                        <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="45px"/>
                        <input type="text" class="border w-100 rounded-pill px-3 py-2 ml-2" id="search" name="search"
                            aria-describedby="searchHelp" placeholder="Search people"/>
                    </div>
                    <div class="scroll-y pt-2" style="height: 600px">
                        @for ($i = 0; $i < 50; $i++)
                            @include('chat.row')
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-8 p-0 m-0">
                {{-- Pass an array of chat objects to this view when the page first loads. --}}
                @include('chat.pane')
                {{-- @include('chat.pane', ['chats' => []]) --}}
            </div>
        </div>
    </div>
@endsection
