<?php
if(!empty($_POST["usrname"])){
    if (login($_POST["usrname"],$_POST["passwd"])){
        header("location:logged.php");
    } else {
        echo "wrong username or password";
    }


}
?>
<?php include "header.php" ?>

<div class="loginForm">
    <form method="post">
        <label for="usrname">Username:</label>
        <input type="text" name="usrname">
        <label for="passwd">Password:</label>
        <input type="password" name="passwd">
        <input type="submit">
    </form></div>


<?php include "footer.php" ?>