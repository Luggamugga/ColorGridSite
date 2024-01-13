<?php
include "mysqlFunctions.php";
if (isset($_POST["chat-input"])) {
    echo "input" .$_SESSION["usrname"].$_SESSION["chatid"];
    addChatMsg($_SESSION["chatid"], $_POST["chat-input"],$_SESSION["usrname"]);
}