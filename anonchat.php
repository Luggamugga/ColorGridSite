<?php
$chatArr = [];
include "header.php";
if(!$_SESSION){
    echo "not logged in";
    echo "<a href='login.php'>LOGIN</a>";
    $loggedIn = false;
    return;
} else {
    $currUser = $_SESSION["usrname"];
    $targetUser = $_GET["chat-to"] ?? null;
}

if($_POST["new-chat-msg "]){
    addChatMsg($chatId,$_POST["new-chat"],$_SESSION["userid"]);
}

?>
<?php if($_GET["chat-to"] && checkUserExists($_GET["chat-to"])):?>
<?php if(mysqli_num_rows(getChatsByUserIds($_SESSION["userId"],getUserIdByName($_GET["chat-to"])))){

};
<div class="chat-container">
    <div class="chat-contents">
        <?php foreach($chatArr as $chat){
            $clr = "";
            if(key($chat) === $currUser){
                $clr = "aliceblue";
            } else {
               $clr = "darkred";
            }
            echo "<div class='chat-msg-label' style='accent-color:{$clr}'>".key($chat)."</div>";
            echo "<div class='chat-msg from:'".key($chat).">".$chat."</div>";
        }
        ?>
    </div>
    <div class="chat-input-container">
        <form method="post">
            <input type="text" name="new-chat-msg" placeholder="blabla">
            <button type="submit">SEND</button>
        </form>
    </div>
</div>
<?php else:?>

<div class="new-chat-container">
    <?php if($_GET["chat-to"]){?>
    <div class="user-error-msg">User does not exist</div>
    <?php
    }?>
    <form method="get">
        <label for="chat-to">
            Enter Username:
            <input type="text" name="chat-to">
        </label>
        <button type="submit" class="new-chat-submit">START CHAT</button>
    </form>
</div>
<?php endif;?>

<div class="my-chats-container">
    <div class="my-chats-header">My Chats</div>
    <?php if($_SESSION){
        $chats = getChatsOfUserId($_SESSION["userId"]);

    }
     ?>
</div>