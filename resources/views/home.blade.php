@extends('layouts.app')

@section('content')
    <div class="containers w-100 h-100 m-0 p-0">
        <div class="row w-100 h-100 m-0">
            <div class="col-4 bg-white p-1 m-0">
               <input type="hidden" value="{{auth()->id()}}" id="user-id">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center my-2 mx-3">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="45px"/>
                        </a>
                        <input type="text" class="border w-100 rounded-pill px-3 py-2 ml-2" id="search-user" name="search"
                            aria-describedby="searchHelp" placeholder="Search people"/>
                    </div>
                    <div class="scroll-y pt-2" style="height: 600px">
                        <!-- @foreach ( $connectedUsers as $user )
                          $lastChat = $user[1];
                          $user = $user[0];
                          $chatText = json_decode($lastChat->chatText)->chatText;
                          @include('chat.row')
                        @endforeach -->

                        @each('chat.row', $connectedUsers, 'user')
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
    <script type="text/javascript" src="{{asset('js/Utility.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/chatprocess.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/ui.js')}}"></script>
@endsection
