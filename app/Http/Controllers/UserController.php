<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //list the chat users that has chatted with this user
    
    //find a user
    public function findUser($credential){
        if($credential[0] == '@'){//searching by username
            $cred = ['username' => $credential];
        }else{
            //searching by email
            $cred = ['email' => $credential];
        }
        return view('search',$cred);
    }

    public static function list(){
        //get all users that you have chatted with
        $userId = auth()->id();
        
        //get all users then those without a message don't get listed
        $users = DB::table('users')->get(['id', 'username']);
        
        $users_list = [];
        foreach($users as $user){
            $lastChat = DB::table('chats')->whereRaw("(senderId = ? and receiverId = ?) or (senderId = ? and receiverId = ?)", [$userId, $user->id, $user->id, $userId])->orderByDesc('created_at')->limit(1)->get();
            if($lastChat->count() > 0){
                $jsonUser_lastChat = json_encode([$user, $lastChat[0]]);
                $users_list[$jsonUser_lastChat] = $lastChat[0]->updated_at;
            }
        }
        
        //sort the array
        arsort($users_list);
        $users_list = array_keys($users_list);
        $users_list = array_map('json_decode', $users_list);
        return $users_list;
    }

    public function getMostRecentChats(Request $request){
        $this->validate($request, [
            'the_user'=> 'required|integer'
        ]);

        $userId = auth()->id();

        $chats = DB::table('chats')
        ->whereRaw("(senderId = ? and receiverId = ?) or (senderId = ? and receiverId = ?)", [$userId, $request->the_user, $request->the_user, $userId])->orderByDesc('created_at')->limit(100)->get();

        $sender = DB::table('users')->whereRaw("id = ?", [$request->the_user])->get('username');
        
        echo view('chat.chats', ['chats' => $chats, 'sender' => $sender]);
    }

}
