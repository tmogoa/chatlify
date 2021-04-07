<div class="d-flex mt-3 flex-row {{$justify}}">
    <div>
        <div style="font-size: 14px; " class="p-3 mx-2 text-white chat-msg {{$from}}">
            {{$chat_text}}
        </div>
        <div class="w-100 d-flex justify-content-end pr-3">
            <span>
                @if ($seen)
                <x-bi-check-all width="20" height="20" style="color: #c2c1c0" />
                @else
                <x-bi-check width="20" height="20" style="color: #c2c1c0" />
                @endif
            <span class='ml-2 time-text'>{{$sent_at}}</span></span>
        </div>
    </div>
</div>
