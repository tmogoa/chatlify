<?php
namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private $lastSeen;
    private $online = false;
    private $connectedUsers = [];
    /**
     * @property $currentConnectedUser is saved as 'user-id'
     */
    private $currentConnectedUser;
    private $connections = [];
    /**
     * The connection from which the message was sent.
     * This will be set by the WebSocketController
     */
    public $sendingConnection = null;
 

    /**
     * Sanitization of the chat text will be done in the WebSocketController
     * @param JSON $message - The message is a Chat Object in a JSON format.
     * This function allows the user to send a message to the current connected user.
     * The current connected user is the user that is currently being chat with.
     * @param $array_of_users the connected users that is maintained by the WebSocketController class.
     * @return 1|2|3 - 1 if the user is online and the message was delivered.
     * 2 if the user is offline but the message was sent and.
     * 3 if the message was not sent. Usually and error will cause this to happen.
     */
    public function sendChat($JSON_chat, $array_of_users)
    {
        echo "In the SendChat function\n";
        if(array_key_exists("user-$this->currentConnectedUser", $array_of_users)){
            $user = $array_of_users[$this->currentConnectedUser];
        }else{
            $user = null;
        }
        
        $chat = json_decode($JSON_chat);
       
        $newChat = Chat::create([
            'chatText' => $JSON_chat,
            'senderId' => $this->id,
            'receiverId' => $this->currentConnectedUser
        ]);
            echo "trying to save the chat in the database\n";
            var_dump($newChat);
        $data = new Data();
        $data->type = "nc";//new chat
        $data->attached = $newChat;

        $JSON_chat = json_encode($data);
        $this->broadcastToAllConnections($JSON_chat);

        if($user == null){
            //Then the user is offline, so save the chat in the database
            if($newChat == null){
                return [3, 0];
            }
            else{
                return [2, $newChat->chatId];
            }
        }
        else{
            if($newChat == null){
                return [3, $newChat->chatId];
            }

            //try to send the user who is online
            $user->broadcastToAllConnections($JSON_chat);

            return [1, $newChat->chatId];
        }
    }

    public function broadcastToAllConnections($json_chat){
        foreach($this->connections as $conn){
            if($this->sendingConnection !== $conn){
                $conn->send($json_chat);
            }
        }
        return true;
    }
    /**
     * Deletes a chat from the database and the users sides.
     */
    public function deleteChat($chatId){
        
    }

    /**
     * This puts a user in the connected users array.
     * The connected users are all the users that have received a message from this user.
     */
    public function connectToUser($newUserId){
        //taking user id and putting it in connected user array
        if(DB::table('users')->where('id', $newUserId)->exists()){
            $this->connectedUsers['user-'.$newUserId] = $newUserId;
        }
        return true;
    }

    /**
     * When the chat is already in the database but hasn't been seen yet by the user, this
     * method is called to send all the messages.
     */
    public function receiveAllChat(){
        $userId = $this->currentConnectedUser;
        $chat = DB::table('chats')->whereRaw("(senderId = ? and receiverId = ?) or (senderId = ? and receiverId = ?)", [$this->id, $userId, $userId, $this->id])
        ->get()
        ->orderByDesc('created_at');

        $chatsArray = [];
        foreach($chat as $ch){
            $chatsArray[] = $ch;
        }

        $data = new Data();
        $data->type = "c-col";//chat collection
        $data->attached = $chatsArray;
        $dataToSend = json_encode($data);
        $this->broadcastToAllConnections($dataToSend);
        return true;
    }

    

    /**
     * Get the value of lastSeen
     * Last seen is the updated_at column of the users table. 
     * It is updated when all of the user's connection has disconnected.
     */ 
    public function getLastSeen()
    {
        $this->lastSeen = $this->updated_at->diffForHumans();
        return $this->lastSeen;
    }

    /**
     * Set the value of lastSeen
     * The datetime that the user was last seen
     * @return  self
     */ 
    public function setLastSeen()
    {
        $this->save();
    }

    /**
     * Get the value of online status.
     * Is the user online or offline.
     */ 
    public function isOnline()
    {
        return $this->online;
    }

    /**
     * Set the value of online
     *
     * @return  self
     */ 
    public function setOnline($online)
    {
        $this->online = $online;
        return $this;
    }

    /**
     * Get the value of connectedUsers
     */ 
    public function getConnectedUsers()
    {
        return $this->connectedUsers;
    }

    /**
     * Set the value of connectedUsers
     *
     * @return  self
     */ 
    public function setConnectedUsers()
    {
    }

    /**
     * Get the value of currentConnectedUser
     */ 
    public function getCurrentConnectedUser()
    {
        return $this->currentConnectedUser;
    }

    /**
     * Set the value of currentConnectedUser
     *
     * @return  self
     */ 
    public function setCurrentConnectedUser($currentConnectedUser)
    {
        $this->currentConnectedUser = $currentConnectedUser;

        return $this;
    }

    /**
     * Get the value of connections
     */ 
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * Set the value of connections
     *
     * @return  self
     */ 
    public function addToConnections(\Ratchet\ConnectionInterface $connection)
    {
        if(in_array($connection, $this->connections)){
            $this->connections[] = $connection;
        }
        return $this;
    }

    public function removeConnection(\Ratchet\ConnectionInterface $conn){
        $index = array_keys($this->connections, $conn);
        if(count($index) > 0){
            unset($this->connections[$index[0]]);
        }
        if(count($this->connections) > 0){
            $this->online = true;
        }else{
            $this->online = false;
        }
       
        return true;
    }
}
