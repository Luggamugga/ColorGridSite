
let inputButt = document.getElementById("chat-box-input-submit")
let input = document.querySelector(".chat-box-input")

websocket.onmessage = function (ev) {
    let response = JSON.parse(ev.data)

    let respone_type = response.type;
    let user_message = response.message;
    let usr_name = response.name;

    switch (respone_type) {
        case 'usernmsg' :
            msgBox.append("<div>" + usr_name + " : " + user_message + "</div>");
            break;
        case 'system':
            msgBox.append(user_message);
            break;
    }
    msgBox[0].scrollTop = msgBox[0].scrollHeight;
};

websocket.onerror = function (ev) {
    msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>');
};
websocket.onclose = function (ev) {
    msgBox.append('<div class="system_msg">Connection Closed</div>');
};

inputButt.addEventListener("click", (ev) => {
    send_message();
})
inputButt.addEventListener("keydown", function (ev) {
    if(ev.key === "Enter"){
        send_message();
    }
})

function send_message(){
   let message_input = input;
   let name_input = document.getElementById("chat-username").innerHTML;

   if(message_input.value === ""){
       alert("enter something bitch")
       return;
   }

   let msg = {
       message:message_input.value,
       name:name_input,
   }
   websocket.send(JSON.stringify(msg));
    message_input.value = "";
}

