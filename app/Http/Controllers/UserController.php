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

    

}
