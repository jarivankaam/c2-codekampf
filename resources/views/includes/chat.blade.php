<div class="chat-container">
    <div class="chatbox-container">
        <div class="chatbox-header">
            <div class="title">
                <p class="chatbox-name">Chat</p>
            </div>
            <div class="exit-btn">
                <button id="close-chatbox">X</button>
            </div>
        </div>
        <div class="message-container hidden" id="message-container"></div>
        <div class="message-container chat-error" id="error-message-box">
            <h2>Kan geen verbinding</h2>
            <h2>maken met de chat!!</h2>
        </div>
        <div class="sendDiv">
            <input type="text" id="chatbox-input" maxlength="250" placeholder="Typ uw bericht..." readonly>
            <button id="send-btn" disabled>Send</button>
        </div>
    </div>
    <button id="open-chatbox">chat</button>
</div>
<script src="js/chat.js"></script>
