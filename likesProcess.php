<?php
include "mysqlFunctions.php";
    $userid = $_POST["userid"] ?? 0;
if(isset($_POST["like"])){
    $gridId = $_POST["like"];
    addLikes($_POST["like"],$_POST["userid"]);
    if(checkIfUsrDisliked($gridId,$userid)){
        rmDislike($gridId,$userid);
    }
    unset($_POST);
} else if($_POST["dislike"]){
    $gridId= $_POST["dislike"];
    addDislike($_POST["dislike"],$_POST["userid"]);
    if(checkIfUsrLiked($gridId,$userid)){
        rmLikes($gridId,$userid);
    }
    unset($_POST);
}
//header('Location: ' . $_SERVER['HTTP_REFERER']);
