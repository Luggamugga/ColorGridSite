<?php
include "mysqlFunctions.php";
include "header.php";
    $usrnameToChatTo = $_POST["usrname"];
    $sessionUsrname = $_SESSION["usrname"];
    $usrnameEqualBool = $usrnameToChatTo == $sessionUsrname;
    $chatId = 0;

    ?>
<script>
    let msgBox = document.querySelector(".chat-box-messages")

    let wsUri = "ws://localhost:8888/chat-server.php";

    websocket = new WebSocket(wsUri);

    websocket.onopen = function (ev) {
        msgBox.append("welcome to chat");
        console.log("connect")
    }
</script>
    <div class="chat-box-container">
        <div class="chat-box-messages">
            <div class="chat-box-input-container">
                <form id="chat-box-send-message" method="post">
                    <span id="chat-username"><?= $sessionUsrname?>: </span>
                    <input type="text" class="chat-box-input" name="chat-input">
                    <button type="button" id="chat-box-input-submit">SEND</button>
                </form>
            </div>
        </div>
    </div>
<script src="chat.js"></script>

<?php
include "footer.php";
?>

