
 let conn = new WebSocket("ws://localhost:8081");
 let uid = 1; //userId
 let selectedUser = 1;
 let chatPane = document.getElementById("chat-pane");
 let userPane = document.getElementById("user-pane");
 let chatTextArea = document.getElementById("chat-text-area");
 let sendChat = document.getElementById("send-chat");
 let searchInput = document.getElementById("search-user");
 

 conn.onopen = function(e){
     sendData({
         type: "su"
     });
 }

 conn.onmessage = function(e){
     let res = JSON.parse(e.data);
     
     switch(res.type){
        case "uo": //user online
            {
                document.getElementById("user-status").innerHTML = "online";
                break;
            }
        case "error": //error
            {
                switch(res.message){
                    case "cus": //cannot update status
                        {
                            
                            break;
                        }
                    case "nsu": //no selected user
                        {
                            Utility.showError("Please select an account to perform the function");
                            break;
                        }
                }
                break;
            }
        case "scd"://sent chat delivered
            {
                document.getElementById("chat-tick-"+res.chatId).innerHTML = "/double-tick/";
                break;
            }
        case "scs": //sent chat sent
            {
                document.getElementById("chat-tick-"+res.chatId).innerHTML = "/one-tick";
                break;
            }
        case "scf": //sent chat fail
            {
                Utility.showError("An error occurred. We could not send your message");
                break;
            }
        case "css": //chat seen successfully 
            {
                document.getElementById("chat-tick-"+res.chatId).innerHTML = "/blue-tick/";
                break;
            }
        case "c-col": //chat collection
            {
                let chatsArray = res.attached;
                chatsArray.forEach(chat => {
                    ///
                });
                break;
            }
        case "nc": //new chat
            {
                break;
            }
        default:
            {

            }
     }
 }
 
 function changeSelectedUser(userElem){
    selectedUser = userElem.id;
    sendData({
        type: "sau",
        rid:selectedUser
    });
 }

 function setSeenStatusObserver(chatElem){
     chatElem = document.getElementById('id');
     if(chatElem.querySelector("#visibilityStatus") == "false"){
         if(inView(chatElem)){
             sendData({
                 type: "upc",
                 chatId: chatElem.id
             });
         }
     }
 }

 sendChat.addEventListener('click', function(){
    if(chatTextArea.value.length > 0){
        sendData({
            type: "sc",
            senderId: uid,
            receiverId: selectedUser,
            chatText: chatTextArea.value
        });
    }
 });



 function sendData(data){
     data.id = uid;
     conn.send(JSON.stringify(data));
 }

 function inView(elem) {
    let elementHeight = elem.clientHeight;
    // get window height
    let windowHeight = window.innerHeight;
    // get number of pixels that the document is scrolled
    let scrollY = window.scrollY || window.pageYOffset;
    
    // get current scroll position (distance from the top of the page to the bottom of the current viewport)
    let scrollPosition = scrollY + windowHeight;
    // get element position (distance from the top of the page to the bottom of the element)
    let elementPosition = element.getBoundingClientRect().top + scrollY + elementHeight;
    
    // is scroll position greater than element position? (is element in view?)
    if (scrollPosition > elementPosition) {
      return true;
    }
    
    return false;
  }
  