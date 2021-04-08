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

    public function list(){
        //get all users that you have chatted with
        $userId = auth()->id;
        
        //get all users then those without a message don't get listed
        $users = DB::table('users')->get(['id', 'username']);
        $users_list = [];
        foreach($users as $user){
            $lastChat = DB::table('chat')->whereRaw("(senderId = ? and receiverId = ?) or (senderId = ? and receiverId = ?)", [$userId, $user->id, $user->id, $userId])->orderByDesc('updated_at')->limit(1)->get();
            if($lastChat->count() > 0){
                $jsonUser_lastChat = json_encode([$user, $lastChat->get(0)]);
                $users_list[$jsonUser_lastChat] = $lastChat->get(0)->updated_at;
            }
        }
        //sort the array
        rsort($users_list);

        //return a json html of the view
        $json_view = view('')
    }

    public function getMostRecentChat(Request $request){

    }

}
