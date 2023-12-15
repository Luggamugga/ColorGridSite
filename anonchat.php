<?php include "header.php"; ?>

<?php if(isset($_SESSION["usrname"]) && !isset($_POST["usrname"])):?>
<form id="requestChatUsrname" method="post">
    <label for="usrname">Start Chat by Username:</label>
    <input type="text" name="usrname">
    <input type="submit">
</form>

<?php
elseif(isset($_POST["usrname"])):
    $usrnameToChatTo = $_POST["usrname"];
    $sessionUsrname = $_SESSION["usrname"];
    $usrnameEqualBool = $usrnameToChatTo == $sessionUsrname;
    if(checkUserExists($usrnameToChatTo) && !$usrnameEqualBool){
        echo "<div>newchat</div>";
    } else {
        echo "<div>err</div>";
    }




?>


<?php else:?>
    <h1><a href="login.php">Login</a> or <a href="register.php">register</a> to chat</h1>
<?php endif;?>
<?php include "footer.php"?>
