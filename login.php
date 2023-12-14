<?php

include "header.php" ;
?>
<?php
$logged = false;
function renderLogin(){
    $returnarr[] = "<div class='loginForm'>";
    $returnarr[] = '<form method="post">
        <label for="usrname">Username:</label>
        <input type="text" name="usrname">
        <label for="passwd">Password:</label>
        <input type="password" name="passwd">
        <input type="submit">
    </form>';
    $returnarr[] = "</div>";
    return implode("",$returnarr);
}
function renderLogged(): string
{
    $returnarr[] = '<div class="Success">';
    $returnarr[] = "<h1>You've successfully logged in as:" . $_SESSION["usrname"]."</h1></div>";
    $returnarr[] = '<div class="successNav"><div class="homeLink"><a href="index.php">Home</a></div><div class="createLink"><a href="create.php">Create a grid!</a></div></div>';
    return implode ("",$returnarr);
}
if(!empty($_POST["usrname"])){
    if (login($_POST["usrname"],$_POST["passwd"])){
        echo renderLogged();
    } else {
        echo "wrong username or password";
    }
    unset($_POST);
} else{
    echo renderLogin();
}
?>

<?php include "footer.php" ?>