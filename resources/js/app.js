require('./bootstrap');

 let conn = new WebSocket("localhost:8081");
 let uid = 1; //userId
 let selectedUser = 1;
 let chatPane = document.getElementById("chat-pane");
 let userPane = document.getElementById("user-pane");
 let chatTextArea = document.getElementById("chat-text-area");
 let sendChat = document.getElementById("send-chat");
 

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
                break;
            }
        case "error": //error
            {
                break;
            }
        case "scd"://sent chat delivered
            {
                break;
            }
        case "scs": //sent chat sent
            {
                break;
            }
        case "scf": //sent chat fail
            {
                break;
            }
        case "css": //chat seen successfully 
            {
                break;
            }
        case "c-col": //chat collection
            {

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
  