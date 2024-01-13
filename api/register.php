<?php
include "mysqlFunctions.php";
include "header.php";
 ?>

<div class="formHeader">Register a new Account</div>
<div class="registForm">
    <form method="post">
        <label for="usrName">Username:</label>
        <input name="usrName" type="text" placeholder="username">
        <label for="passwd">Password</label>
        <input name="passwd" type="text" placeholder="Password">
        <input type="submit">
    </form>
</div>
<?php
if (isset($_POST["usrName"])):
    if (isset($_SESSION["usrname"])) {
        echo "your're already logged in and registered";
        return;
    } elseif (checkUserExists($_POST["usrName"])) {
        echo "that usrname is taken!";
        return;
    } else {
        addUser($_POST["usrName"], $_POST["passwd"]);
        header("Location: regSuccess.php");
    }
endif;
?>
<?php include "footer.php" ?>
