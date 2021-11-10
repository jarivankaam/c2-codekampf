let myStorage = localStorage || window.localStorage;
let socket = new WebSocket("wss://pra-chat.herokuapp.com/socket");
let messagesDiv = document.getElementById('message-container');
let chatConnected = false;

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

socket.onopen = function(e) {
    chatConnected = true;
    updateChatStatus();
};

socket.onmessage = function(event) {
    let jsonDate = JSON.parse(event.data);
    let uuid = myStorage.getItem("uuid");
    let timestamp = timeConverter(jsonDate.created_at);

    if(jsonDate.uuid === uuid){
        messagesDiv.innerHTML += '<div class="message message-right"><div class="timestamp">'+timestamp+'</div><div class="content">'+jsonDate.content+'</div></div>';
    }else{
        messagesDiv.innerHTML += '<div class="message message-left"><div class="timestamp">'+timestamp+'</div><div class="content">'+jsonDate.content+'</div></div>';
    }

    scrollBottom();
};

socket.onclose = function(event) {
    chatConnected = false;
    updateChatStatus();
    if (event.wasClean) {
        console.log(`Connection closed cleanly, code=${event.code} reason=${event.reason}`);
    }
};

function sendMessage(messageJson){
    updateChatStatus();
    if (!chatConnected){
        return;
    }

    axios.post('/chat/messages', messageJson).then(response => {
        if(response.data.statusCode === 200){
            messageJson['created_at'] = new Date().getTime();
            socket.send(JSON.stringify(messageJson));

            scrollBottom();
        }else{
            console.log(response);
        }
    })
    .catch(function (error) {
        console.log(error);
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
    if(myStorage.getItem("uuid") == null){
        myStorage.setItem("uuid", uuidv4());
    }

    document.getElementById("chatbox-input").addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("send-btn").click();
        }
    });

    document.getElementById("send-btn").addEventListener("click", function(event) {
        console.log("click");
        let uuid = myStorage.getItem("uuid");
        let content = document.getElementById("chatbox-input").value;

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
            let uuid = myStorage.getItem("uuid");
            response.data.messages.forEach(message => {
                let timestamp = timeConverter(message.created_at);

                if(message.uuid === uuid){
                    messagesDiv.innerHTML += '<div class="message message-right"><div class="timestamp">'+timestamp+'</div><div class="content">'+message.content+'</div></div>';
                }else{
                    messagesDiv.innerHTML += '<div class="message message-left"><div class="timestamp">'+timestamp+'</div><div class="content">'+message.content+'</div></div>';
                }
                scrollBottom();
            });
        }else{
            console.log(response);
        }
    });

}
