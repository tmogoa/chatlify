<div class="d-flex flex-column w-100 border-left h-100 overf-hide">
    <div class="chat-title-bar d-flex flex-row w-100 align-items-center p-2 border-bottom">
        <div class="rounded-circle d-flex border p-1 my-1 mx-2" style="
          width: 48px;
          height: 48px;
        ">
            <x-bi-person-fill width="36" height="36" style="color: #00ccff" />
        </div>
        <div class="d-flex flex-column ml-2">
            <span class="name-in-title-bar">Levi Kamara</span>
            <span class="small-chat-text">Last seen today at 4.35PM</span>
        </div>
    </div>
    <div class="flex-grow-1 overf-hide">
        <div class="w-100 scroll-y p-3" style="height: 530px">
            @for ($i = 0; $i < 50; $i++)
                @if ($i % 2 == 0)
                    @include('chatView', ['justify' => 'justify-content-end', 'from' => 'sb13'])
                @else
                    @include('chatView', ['justify' => 'justify-content-start', 'from' => 'sb14'])
                @endif
            @endfor
        </div>
    </div>
    <div class="chat-send-bar w-100 border-top">
        <form class="d-flex flex-row p-2 align-items-center justify-content-center">
            <textarea name="chat" id="" cols="70" rows="2" class="rounded border chatbox p-2 ml-1 mr-4 flex-grow-1"
                placeholder="type message here"></textarea>
            <button class="rounded-circle d-flex border p-1 my-1 ml-3 mx-2" style="
            width: 48px;
            height: 48px;
          ">
                <x-bi-cursor-fill width="36" height="36" style="color: #4affa4" />
            </button>
        </form>
    </div>
</div>
