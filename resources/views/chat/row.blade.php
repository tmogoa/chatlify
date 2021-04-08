<div class="d-flex flex-row w-100 align-items-center p-2 border-bottom row-hover" id="user-{{$user[0]->id}}" onclick="changeSelectedUser(this)">
    <div class="rounded-circle d-flex border p-1 my-1 mx-2" style="
          width: 48px;
          height: 48px;
        ">
        <x-bi-person-fill width="36" height="36" style="color: #00ccff" />
    </div>
    <div class="d-flex flex-column justify-content-between w-100 h-100">
        <div class="d-flex flex-row justify-content-between">
            <span id='username'>{{$user[0]->username}}</span>
            <span class='time-text'>{{date( 'h:m', strtotime($user[1]->created_at))}}</span>
        </div>
        <div class="d-flex flex-row align-items-center">
            <x-bi-check width="20" height="20" style="color: #c2c1c0" />
            <span class="small-chat-text d-inline-block text-truncate" style="max-width: 320px;">
           {{json_decode($user[1]->chatText)->chatText}}
            </span>
        </div>
    </div>
</div>
