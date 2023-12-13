<?php
session_start();

$dbhost = 'db5011366642.hosting-data.io';
$dbname = "dbs9593474";
$dbuser = 'dbu1596496';
$dbpasswd = "IonosPass123!";
$mysqli = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname) or die("Connect failed: %s\n" . $mysqli->error);

function addUser($usrname, $passwd)
{
    global $mysqli;
    $query = sprintf("INSERT INTO user (usrname,passwd)
VALUES('%s','%s')", $usrname, $passwd);
    $mysqli->query($query);
}

function checkUserExists($usrname)
{
    global $mysqli;
    $check = sprintf("SELECT * FROM user WHERE usrname='%s'", $usrname);
    $checkRes = $mysqli->query($check);
    $res = mysqli_fetch_assoc($checkRes);
    if (!empty($res)) {
        return true;
    } else if ($usrname != null) {
        return false;
    }
}
function getUserIdByName($username){
    global $mysqli;
    $query = sprintf("SELECT id FROM user WHERE usrname=%s",$username);
    return mysqli_fetch_assoc($mysqli->query($query));
}

function login($usrname, $passwd)
{
    global $mysqli;
    $query = sprintf("SELECT * FROM user WHERE usrname='%s' AND passwd='%s'", $usrname, $passwd);
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row["usrname"] === $usrname && $row["passwd"] === $passwd) {
            $_SESSION["usrname"] = $usrname;
            $_SESSION["userid"] = $row["id"];
            return true;
        }
    } else {
        return false;
    }
}

function logout()
{
    if (isset($_SESSION)) {
        unset($_SESSION["userid"]);
        unset($_SESSION["usrname"]);
        session_destroy();
    }
}

function saveGrid($userid, $gridArray)
{
    global $mysqli;
    $jsonGrid = json_encode($gridArray);
    $query = sprintf("INSERT INTO grids(userId,grid) VALUES('%s','%s');", $userid, $jsonGrid);
    $mysqli->query($query);

}

function getGridsUserid($userid)
{
    global $mysqli;
    $query = sprintf("SELECT grid FROM grids WHERE userId='%s'", $userid);
    $result = $mysqli->query($query);
    print_r($result);
}

function getUserbyId($userid)
{
    global $mysqli;
    $query = sprintf("SELECT usrname FROM user WHERE id=%d", $userid);
    $result = $mysqli->query($query);
    $row = mysqli_fetch_assoc($result);
    return $row["usrname"];
}

function getAllGrids()
{
    global $mysqli;
    $query = "SELECT * FROM grids";
    $result = $mysqli->query($query);

    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='gridContainer'>";
        echo "<div class='grid'>";
        $array = json_decode($row["grid"], true);
        for ($i = 0; $i < 64; $i++) {
            $string = "<div class='box' id='" . $i . "' style=background-color:" . $array["g" . $i] . ";'></div>";
            echo $string;
        }
        $usrname = getUserbyId($row["userId"]);
        $userid = $row["userId"];
        $gridId = $row["id"];
        $sessUsrId = $_SESSION["userid"];
        echo "</div>";
        echo "<div class='gridSubtxt'>";
        echo "<div class='usrnameHome'> By User: ";
        echo "<a href='profile.php?usr=" . $userid . "'>" . $usrname . "</a></div>";
        echo "<div class='timestamp'>Created: " . $row["time"] . "</div>";
        include "likes.php";
        if ($_SESSION["userid"] == $userid) {
            echo "<a href='index.php?delId=" . $gridId . "'>delete</a>";
            echo "<a href='create.php?gridId=" . $gridId . "'>edit </a>";
        }
        echo "<div class='viewGrid'><a href='view.php?gridId=".$gridId."'>View</a></div>";
        echo "<div class='comments'><a href='view.php?gridId=".$gridId."'>View Comments</div>";
        echo "</div>";
        echo "</div>";
    }
}

function getGridsByUsrId($userid)
{
    global $mysqli;
    $query = sprintf("SELECT * FROM grids WHERE userid='%d'", $userid);
    $result = $mysqli->query($query);

    $count = 1;

    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='gridContainer'>";
        // echo "<div class='gridCounter'>".$count.". </div>";
        echo "<div class='grid'>";
        $array = json_decode($row["grid"], true);
        include "grid.php";
        $userid = $row["userId"];
        $gridId = $row["id"];
        echo "</div>";
        echo "<div class='gridSubtxt'>";
        echo "<div class='timestamp'>Created: " . $row["time"] . "</div>";
        echo "<div class='likesFormContainer'>";
        echo "<div class='likesDiv'><button><img class='like' src='img/like.jpeg'></button>";
        echo showLikes($gridId) . "</div>";
        echo "<div class='dislikesDiv'><button><img class='dislike' src='img/dislike.jpeg'></button>";
        echo showDislikes($gridId) . "</div></div>";
        if ($_SESSION["userid"] == $userid) {
            echo "<a href='index.php?delId=" . $gridId . "'>delete</a>";
            echo "<a href='create.php?gridId=" . $gridId . "'>edit </a>";
        }
        echo "</div>";
        $count++;
        echo "</div>";
    }
}

function getGridById($gridId)
{
    global $mysqli;
    $query = sprintf("SELECT * FROM grids WHERE id=%d", $gridId);
    $result = $mysqli->query($query);
    $row = mysqli_fetch_array($result);
    return $row;

}

function deleteGrid($gridId)
{
    global $mysqli;
    $query = sprintf("DELETE FROM grids WHERE id=%d", $gridId);
    $mysqli->query($query);

}

function editGrid($gridId, $gridArray, $userid)
{
    global $mysqli;
    $jsonGrid = json_encode($gridArray);
    $query = sprintf("UPDATE grids SET grid='%s' WHERE id='%d' AND userId='%d'", $jsonGrid, $gridId, $userid);
    $mysqli->query($query);

}

function addLikes($gridId, $userid)
{
    global $mysqli;
    $query = sprintf("UPDATE grids SET likes=likes+1 WHERE id=%d", $gridId);
    $mysqli->query($query);
    $query2 = sprintf("INSERT INTO likes(gridId,UserId) VALUES(%d,%d)", $gridId, $userid);
    $mysqli->query($query2);

}
function rmLikes($gridId,$userid)
{
    global $mysqli;
    $query = sprintf("UPDATE grids SET likes=likes-1 WHERE id=%d",$gridId);
    $mysqli->query($query);
    $query2 = sprintf("DELETE FROM likes WHERE UserId=%d AND gridId=%d",$userid,$gridId);
    $mysqli->query($query2);
}


function showLikes($gridId)
{
    global $mysqli;
    $query = sprintf("SELECT likes FROM grids WHERE id=%d", $gridId);
    $result = $mysqli->query($query);
    $row = mysqli_fetch_assoc($result);
    return $row["likes"];
}

function checkIfUsrLiked($gridId, $userid): bool
{
    global $mysqli;
    $query = sprintf("SELECT id FROM likes WHERE UserId=%d AND gridId=%d", $userid, $gridId);
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function addDislike($gridId, $userid)
{
    global $mysqli;
    $query = sprintf("UPDATE grids SET dislikes=dislikes+1 WHERE id=%d", $gridId);
    $mysqli->query($query);
    $query2 = sprintf("INSERT INTO dislikes(gridId,UserId) VALUES(%d,%d)", $gridId, $userid);
    $mysqli->query($query2);

}
function rmDislike($gridId,$userid){
    global $mysqli;
    $query = sprintf("UPDATE grids SET dislikes=dislikes-1 WHERE id=%d",$gridId);
    $mysqli->query($query);
    $query2 = sprintf("DELETE FROM dislikes WHERE UserId=%d AND gridId=%d",$userid,$gridId);
    $mysqli->query($query2);
}

function showDislikes($gridId)
{
    global $mysqli;
    $query = sprintf("SELECT dislikes FROM grids WHERE id=%d", $gridId);
    $result = $mysqli->query($query);
    $row = mysqli_fetch_assoc($result);
    return $row["dislikes"];
}

function checkIfUsrDisliked($gridId, $userid)
{
    global $mysqli;
    $query = sprintf("SELECT id FROM dislikes WHERE UserId=%d AND gridId=%d", $userid,$gridId);
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
function addComment($comment,$gridId,$userid){
    global $mysqli;
    $query = sprintf("INSERT INTO comments (gridId,UserId,Comment) VALUES(%d,%d,'%s')",$gridId,$userid,$comment);
    $mysqli->query($query);
}
function getComments($gridId): array
{
    global $mysqli;
    $query = sprintf("SELECT * FROM Comments WHERE gridId=%d",$gridId);
    $result = $mysqli->query($query);
    return mysqli_fetch_all($result);

}
function getChatsOfUserId($userId): array
{
    global $mysqli;
    $query = sprintf("SELECT chatsdata FROM CHATS WHERE user1id=%d OR user2id=%d",$userId);
    $result = $mysqli->query($query);
    return mysqli_fetch_all($result);
}
function getChatById($chatId){
    global $mysqli;
    $query = sprintf("SELECT chatsdata FROM CHATS WHERE idCHATS=%d",$chatId);
    $result = $mysqli->query($query);
    return mysqli_fetch_assoc($result);
}
//syntax for chat strings : user:string -> asdf: Hello
function addChatMsg($chatId,$newChatString,$userid){
    global $mysqli;
    $chat = getChatById($chatId);
    $newChatJSON = json_encode($newChatString);
    $chat .= $newChatJSON . ";";
    $query = sprintf("UPDATE CHATS SET chatsdata=%d WHERE idCHATS=%s",$chat,$chatId);
    return $mysqli->query($query);
}
function newChat($user1id,$user2id){
    global $mysqli;
    $users = [$user1id,$user2id];
    $usersJSON = json_encode($users);
    $query = sprintf("INSERT INTO CHATS (users) VALUES(%a)",$usersJSON);
     $mysqli->query($query);
     $query2 = sprintf("SELECT idCHATS FROM CHATS WHERE users=%d",$usersJSON);
     return mysqli_fetch_assoc($mysqli->query($query2));
}
function getChatsByUserIds($userid1,$userid2): array
{
    global $mysqli;
    $users = [$userid1,$userid2];
    $usersJSON = json_encode($users);
    $query = sprintf("SELECT * FROM CHATS WHERE users='%d'",$usersJSON);
    $result = $mysqli->query($query);
    return mysqli_fetch_all($result);
}