<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Http\Request;
use App\Models\User;

class ChatServerController extends  Controller implements MessageComponentInterface
{

    private $currentOnlineUsers = [];
    
     /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    public function onOpen(ConnectionInterface $conn){
        //do nothing
    }
    
     /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    public function onClose(ConnectionInterface $conn){
        
    }
    
     /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    public function onError(ConnectionInterface $conn, \Exception $e){
        
    }
    
     /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $conn The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     * Messages will be in JSON format.
     * Every message will have an id field.
     * Every message will have a type.
     * The type of the message will determine what attributes it has.
     * The message will be constructed by JS
     */
    public function onMessage(ConnectionInterface $conn, $msg){
        $jsonMsg = $msg;
        $msg = json_decode($msg);
      
        $userId = $msg->id;
        switch($msg->type)
        {
            case "su"://store user
                {
                   
                    $this->registerUser($userId, $conn);
                    break;
                }
            case "vc": //view chat... an id is given you will 
                {
                    $user = $this->currentOnlineUsers["user-$userId"];
                    if($user->getCurrentConnectedUser() == null){
                        $message = 
                        '{
                            "type":"error",
                            "message":"nsu"
                        }';
                        //nsu means no selected user
                        $user->broadcastToAllConnections($message);
                    }
                    else{
                        $user->receiveAllChat();
                    }
                    break;
                }
            case "sau": //set active user
                {
                    $user = $this->currentOnlineUsers["user-$userId"];
                    $user->setCurrentConnectedUser($msg->rid);//rid is the receiver Id
                    break;
                }
            case "sc": //send chat to the active user
                {
                    $user = $this->currentOnlineUsers["user-$userId"];

                    if($user->getCurrentConnectedUser() == null){
                        $message = 
                        '{
                            "type":"error",
                            "message":"nsu"
                        }';
                        //nsu means no selected user
                        $user->broadcastToAllConnections($message);
                        return;
                    }

                    $res = $user->sendChat($jsonMsg, $this->currentOnlineUsers);
                    $sentStatus = $res[0];
                    $chatId = $res[1];
                    switch($sentStatus){
                        case 1:
                            {
                                //message was successfully sent and the receiver is online.
                                //therefore the message was delivered.
                                $message = 
                                '{
                                    "type":"scd",
                                    "message":"delivered",
                                    "chatId": $chatId
                                 }';
                                 //sent chat delivered
                                break;
                            }
                        case 2:
                            {
                                //the message was sent but the receiver is offline.
                                //one tick
                                $message = 
                                '{
                                    "type":"scs",
                                    "message":"sent",
                                    "chatId":$chatId
                                 }';
                                 //sent chat sent
                                break;
                            }
                        case 3:
                            {
                                //an error occurred so the message was not sent
                                $message = 
                                '{
                                    "type":"scf",
                                    "message":"failed",
                                    "chatId":$chatId
                                 }';
                                 //sending chat failed
                                break;
                            }
                        default:
                            {
                                break;
                            }
                    }
                    $user->broadcastToAllConnections($message);
                    break;
                }
            case "upc": //update chat usually when the seen status has changed
                {
                    $user = $this->currentOnlineUsers["user-$userId"];

                    $chatId = $msg->chatId;
                    $chat = Chat::find($chatId);
                    if($chat == null){
                        $message = 
                        '{
                            "type":"error",
                            "message":"cannot update status",
                            "chatId":$chatId
                         }';
                         $user->broadcastToAllConnections($message);
                    }
                    $chatText = $chat->chatText;
                    $chatText = json_decode($chatText, true);
                    $chatText['visibilityStatus'] = true;
                    $chatText = json_encode($chatText);
                    $chat->chatText = $chatText;
                    $chat->save();
                    if($this->isInOnlineUsersArray($chat->receiverId)){
                        $receiver = $this->currentOnlineUsers["user-$chat->receiverId"];
                        $message = 
                        '{
                            "type":"css",
                            "message":"message seen",
                            "chatId":$chatId
                            "receiver":$chat->receiverId
                         }';
                         //chat seen successfully
                        $receiver->broadcastToAllConnections($message);
                    }
                    break;
                }
            default:
            {
                //do nothing
            }
        }
    }

    /**
     * Removes a user when all of their connections have disconnected.
     * 
     */
    public function removeUser(ConnectionInterface $conn){
        $index = array_keys($this->user, $conn);
    
        if(count($index)>0){
            $this->online = true;
        }
        else{
            $this->online=false;
        }
        return true;
    }
    

    /**
     * Add a user to the currentOnlineUsers Array
     * return bool
     */
    public function registerUser($userId, ConnectionInterface $fromConnection){
        if(!array_key_exists("user-$userId", $this->currentOnlineUserse)){
            $newUser = User::find($userId);
            $newUser->setOnline(true);
            $newUser->addToConnections($fromConnection);
            $this->currentOnlineUsers["user-$userId"] = $newUser;
        }
        else{
            $this->currentOnlineUsers["user-$userId"]->addToConnections($fromConnection);
        }
        return true;
    }

    /**
     * Checks if a user is in the currentOnlineUsers array
     */
    public function isInOnlineUsersArray($userId){
        if(array_key_exists("user-$userId", $this->currentOnlineUsers)){
            return true;
        }else{
            return false;
        }
    }
}
