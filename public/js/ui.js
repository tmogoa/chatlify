const pane = document.getElementById("chatPane");

/**
 * @param {String} chatText is the chat message
 * @returns {String}
 * @param {CSS} styleClass contains either justify-content-end or justify-content-start
 * dependent on who has sent the chat
 */
function chatView(chat, user) {
    const styleClass1 =
        user.id === chat.senderId
            ? "justify-content-end"
            : "justify-content-start";
    const styleClass2 = user.id === chat.senderId ? "sb13" : "sb14";

    const chatView = `<div class='d-flex mt-3 flex-row ${styleClass1}' id='${chat.chatId}'>
    <div>
        <div style='font-size: 14px; ' class='p-3 mx-2 text-white chat-msg ${styleClass2}'>
            ${chat.message}
        </div>
        <div class='w-100 d-flex justify-content-end pr-3 align-items-center'>
            <span>
                <svg xmlns='http://www.w3.org/2000/svg' width='20' id='tick-${chat.chatId}' height='20' style='color: #c2c1c0' fill='currentColor' class='bi bi-check-all' viewBox='0 0 16 16'>
                    <path d='M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z'/>
                </svg>
            </span>
            <span class='ml-2 time-text'>${chat.sentDate}</span>
        </div>
    </div>
    </div>
    `;

    const container = document.createElement("div");
    container.innerHTML = chatView;
    return container;
}
/**
 * Adds a chat view to the chat pane
 *
 * @param {Chat} chat The chat object
 */
function addChat(chat, user) {
    pane.appendChild(chatView(chat, user));
}

/**
 *
 * @param {number} chatId id of the chat view which should be blue-ticked
 * The chatId should be translatable to the id of the double-tick svg element.
 */

function markAsRead(chatId) {
    document.getElementById("tick-" + chatId).style.color = "dodgerblue";
}

/**
 * remove the view which is shown when no user is currently clicked.
 */
function emptyChatPane() {
    pane.innerHTML = "";
}

// Carrying out test

// var chat = {
//     chatId: "13",
//     senderId: "12",
//     message: "Hey! this is a chat.",
//     sentDate: "2.45PM",
// };

// const user1 = {
//     id: "12",
// };

// const user2 = {
//     id: "10",
// };

// emptyChatPane();
// addChat(chat, user1);

// setTimeout(function () {
//     markAsRead(chat.chatId);
// }, 3000);
