<div class="d-flex mt-3 flex-row {{$justify}}" id="chat-{{$chat->chatId}}">
    <div>
        <div style="font-size: 14px; " class="p-3 mx-2 text-white chat-msg {{$from}}">
            {{json_decode($chat->chatText)->chatText}}
        </div>
        <div class="w-100 d-flex justify-content-end pr-3 align-items-center">
            <span>
<<<<<<< HEAD
                @if (json_decode($chat->chatText)->visibilityStatus == true)
                <x-bi-check-all width="20" height="20" style="color: #c2c1c0" />
                @else
                <x-bi-check width="20" height="20" style="color: #c2c1c0" />
                @endif
            <span class='ml-2 time-text'>{{$chat->created_at}}</span></span>
=======
                <x-bi-check-all width="20" height="20" style="color: #c2c1c0" />
            </span>
            <span class='ml-2 time-text'>{{$sent_at}}</span>
>>>>>>> 8f764c146f93bbad18e2c118613b73f9bcfa272c
        </div>
    </div>
</div>
