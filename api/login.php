<?php
include "mysqlFunctions.php";
include "header.php";
if(!empty($_POST["usrname"])){
    login($_POST["usrname"],$_POST["passwd"]);
    unset($_POST);
} else {
    echo renderLogin();

}

$logged = false;

?>
<?php include "footer.php" ?>