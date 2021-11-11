let myStorage = localStorage || window.localStorage;
let socket;
let messagesDiv = document.getElementById('message-container');
let chatConnected = false;

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getUUID(){
    return myStorage.getItem("chat_session_uuid");
}

function setUUID(value){
    myStorage.setItem("chat_session_uuid", value);
    setCookie("chat_session_uuid", value, 365);
}

const socketConnectListener = (event) => {
    chatConnected = true;
    updateChatStatus();
};

const socketDisconnectListener = (event) => {
    chatConnected = false;
    updateChatStatus();

    setTimeout(function() {
        startWebsocket();
    }, 500);
};

const socketMessageListener = (event) => {
    let jsonDate = JSON.parse(event.data);
    let uuid = getUUID();
    let timestamp = timeConverter(jsonDate.created_at);

    if(jsonDate.uuid === uuid){
        messagesDiv.innerHTML += '<div class="message message-right"><div class="timestamp">'+timestamp+'</div><div class="content">'+jsonDate.content+'</div></div>';
    }else{
        messagesDiv.innerHTML += '<div class="message message-left"><div class="timestamp">'+timestamp+'</div><div class="content">'+jsonDate.content+'</div></div>';
    }

    scrollBottom();
};

function startWebsocket(){
    socket = new WebSocket("wss://pra-chat.herokuapp.com/socket");
    socket.addEventListener('open', socketConnectListener);
    socket.addEventListener('message', socketMessageListener);
    socket.addEventListener('close', socketDisconnectListener);
}
startWebsocket();

$('#open-chatbox').click(function () {
    $('.chatbox-container').css("visibility", "visible");
    $('#open-chatbox').css("visibility", "hidden");
    scrollBottom();
});
$('#close-chatbox').click(function () {
    $('.chatbox-container').css("visibility", "hidden");
    $('#open-chatbox').css("visibility", "visible");
});

function scrollBottom() {
    let message_container = $('.message-container');
    message_container.scrollTop(message_container.prop("scrollHeight"));
}

function uuidv4() {
    return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}

function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = Math.round(a.getHours());
    var min = Math.round(a.getMinutes());
    var sec = Math.round(a.getSeconds());
    return date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
}

function sendMessage(messageJson){
    updateChatStatus();
    if (!chatConnected){
        return;
    }

    axios.post('/chat/messages', messageJson).then(response => {
        if(response.data.statusCode === 200){
            messageJson['created_at'] = new Date().getTime();
            socket.send(JSON.stringify(messageJson));
        }else{
            messagesDiv.innerHTML += '<div class="message message-right message-error"><div class="timestamp">'+response.data.status+'</div><div class="content">'+messageJson.content+'</div></div>';
        }
        scrollBottom();
    });
}

function updateChatStatus(){
    if (!chatConnected){
        document.getElementById("error-message-box").classList.remove("hidden");
        document.getElementById("message-container").classList.add("hidden");
        document.getElementById("chatbox-input").setAttribute("readonly", "");
        document.getElementById("send-btn").setAttribute("disabled", "");
    }else{
        document.getElementById("error-message-box").classList.add("hidden");
        document.getElementById("message-container").classList.remove("hidden");
        document.getElementById("chatbox-input").removeAttribute("readonly");
        document.getElementById("send-btn").removeAttribute("disabled");
    }
}

window.onload = function (){
    if(getUUID() == null){
        setUUID(uuidv4());
    }

    document.getElementById("chatbox-input").addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("send-btn").click();
        }
    });

    document.getElementById("send-btn").addEventListener("click", function(event) {
        let uuid = getUUID();
        let content = document.getElementById("chatbox-input").value;

        if(content.length < 1){
            return;
        }

        let jsonMessage = {
            "uuid": uuid,
            "content": content
        };

        document.getElementById("chatbox-input").value = "";
        sendMessage(jsonMessage);
    });

    updateChatStatus();
    if (!chatConnected){
        return;
    }

    axios.get('/chat/messages').then(response => {
        if(response.data.statusCode === 200){
            let uuid = getUUID();
            response.data.messages.forEach(message => {
                let timestamp = timeConverter(message.created_at);

                if(message.uuid === uuid){
                    messagesDiv.innerHTML += '<div class="message message-right"><div class="timestamp">'+timestamp+'</div><div class="content">'+message.content+'</div></div>';
                }else{
                    messagesDiv.innerHTML += '<div class="message message-left"><div class="timestamp">'+timestamp+'</div><div class="content">'+message.content+'</div></div>';
                }
                scrollBottom();
            });
        }
    });

}
