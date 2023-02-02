<?php include "header.php" ?>
<div class="loginForm">
    <form method="post">
        <label for="usrname">Username:</label>
        <input type="text" name="usrname">
        <label for="passwd">Password:</label>
        <input type="password" name="passwd">
        <input type="submit">
    </form></div>
    <?php
    if(!empty($_POST["usrname"])){
       echo login($_POST["usrname"],$_POST["passwd"]);}
    ?>

<?php include "footer.php" ?>