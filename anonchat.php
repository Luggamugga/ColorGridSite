<?php
include "mysqlFunctions.php";
include "header.php"; ?>
<?php if(isset($_SESSION["usrname"]) && !isset($_POST["usrname"])):?>
<form id="requestChatUsrname" method="post" action="chatroom.php">
    <label for="usrname">Start Chat by Username:
    <input type="text" name="usrname">
    </label>
    <input type="submit">
</form>



<?php else:?>
    <h1><a href="login.php">Login</a> or <a href="register.php">register</a> to chat</h1>
<?php endif;?>
<?php include "footer.php"?>
