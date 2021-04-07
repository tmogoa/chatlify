<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    private $currentConnectedUser;
    private $connections = [];
 

    /**
     * @param JSON $message - The message is a Chat Object in a JSON format.
     * This function allows the user to send a message to the current connected user.
     * The current connected user is the user that is currently being chat with.
     * @return 1|2|3 - 1 if the user is online and the message was delivered.
     * 2 if the user is offline but the message was sent and.
     * 3 if the message was not sent. Usually and error will cause this to happen.
     */
    public function sendChat($JSON_chat)
    {

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

    }

    /**
     * When the chat is already in the database but hasn't been seen yet by the user, this
     * method is called to send all the messages.
     */
    public function receiveChat($JSON_chat){

    }

    

    /**
     * Get the value of lastSeen
     */ 
    public function getLastSeen()
    {
        return $this->lastSeen;
    }

    /**
     * Set the value of lastSeen
     * The datetime that the user was last seen
     * @return  self
     */ 
    public function setLastSeen($lastSeen)
    {
        $this->lastSeen = $lastSeen;

        return $this;
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
    public function setConnectedUsers($connectedUsers)
    {
        $this->connectedUsers = $connectedUsers;

        return $this;
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
    public function addToConnections($connection)
    {
        $this->connections[] = $connection;

        return $this;
    }
}
