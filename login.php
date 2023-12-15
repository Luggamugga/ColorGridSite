<?php
include "mysqlFunctions.php";
include "header.php";
$logged = false;
if(!empty($_POST["usrname"])){
    login($_POST["usrname"],$_POST["passwd"]);
    unset($_POST);
} else {
    echo renderLogin();

}

?>
<?php include "footer.php" ?>