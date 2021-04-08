 
 @foreach ($chats as $chat)
     @if (auth()->id() == $chat->senderId)
         @include('chat.view', ['justify' => 'justify-content-end', 'from' => 'You', 'seen' => true, 'sent_at' => '3.45PM', 'chat_text' => 'blahd'])
     @else
        @include('chat.view', ['justify' => 'justify-content-start', 'from' => $sender, 'seen' => false, 'sent_at' => '4.50PM', 'chat_text' => 'Really, i did not see your call'])
     @endif
 @endforeach
