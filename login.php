<?php

include "header.php" ;
?>
<?php
$logged = false;

if(!empty($_POST["usrname"])){
    login($_POST["usrname"],$_POST["passwd"]);
} else{
    echo renderLogin();
}
?>
<?php include "footer.php" ?>