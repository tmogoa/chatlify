
 let conn = new WebSocket("ws://localhost:8081");
 let uid = document.getElementById('user-id').value; //userId
 let selectedUser = 0;
 let chatPane = document.getElementById("chat-pane");
 let userPane = document.getElementById("user-pane");
 let chatTextArea = document.getElementById("chat-text-area");
 let sendChat = document.getElementById("send-chat");
 let searchInput = document.getElementById("search-user");
 
 window.onload = initViariables;
 function initViariables(){
    chatPane = document.getElementById("chat-pane");
    userPane = document.getElementById("user-pane");
    chatTextArea = document.getElementById("chat-text-area");
    sendChat = document.getElementById("send-chat");
    searchInput = document.getElementById("search-user");
 }
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
                console.log(res);
                break;
            }
        default:
            {

            }
     }
 }
 
 function changeSelectedUser(userElem){
    selectedUser = userElem.id.split("-")[1];
    sendData({
        type: "sau",
        rid:selectedUser
    });

    //send the ajax request to show the chats
    Utility.main_ajax_with_call_back(listUsers, "/chats", "the_user="+selectedUser, "GET");
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
            chatText: chatTextArea.value,
            visibilityStatus: false
        });
        console.log("Sending message");
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
  
  function listUsers(xhttp){
      document.getElementById('s-username').innerHTML = document.getElementById('user-'+selectedUser).querySelector('#username').innerHTML;
      let res = xhttp.responseText;
      chatPane.innerHTML = res;
  }

  function addChatToPane(response, from = 'self'){
      let chatId = response.attached.chatId;
      let chatText = JSON.parse(response.attached.chatText).chatText;
      let chatTime = response.attached.created_at;
      let chatElem = "";
      if(from !== 'self'){
        chatElem = "<div class='d-flex mt-3 flex-row justify-content-end' id='chat-'"+chatId+"><div><div style='font-size: 14px; ' class='p-3 mx-2 text-white chat-msg sb14'>"+chatText+"</div><div class='w-100 d-flex justify-content-end pr-3 align-items-center'><span><x-bi-check width='20' height='20' style='color: #c2c1c0' id='visibility-status' /><span class='ml-2 time-text'>"+chatTime+"</span></span></div></div><input type='hidden' id='visibility-status' value='false'></div>";
      }
      else
      {
        chatElem = "<div class='d-flex mt-3 flex-row justify-content-start' id='chat-'"+chatId+"><div><div style='font-size: 14px; ' class='p-3 mx-2 text-white chat-msg sb13'>"+chatText+"</div><div class='w-100 d-flex justify-content-end pr-3 align-items-center'><span><x-bi-check width='20' height='20' style='color: #c2c1c0' id='visibility-status' /><span class='ml-2 time-text'>"+chatTime+"</span></span></div></div><input type='hidden' id='visibility-status' value='false'></div>";
      }
      
      chatPane.innerHTML += chatElem;

  }
