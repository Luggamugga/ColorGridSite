<?php
//include "mysqlFunctions.php";
include "header.php";
if(isset($_POST["commentString"])){
    addComment($_POST["commentString"],$_POST["gridId"],$_SESSION["userid"]);
    unset($_POST);
    header("Refresh:0");
}
$row = null;
$array = null;
if (isset($_GET["gridId"])) {
    $row = getGridById($_GET["gridId"]);
    $array = json_decode($row["grid"], true);
} else {
    echo "grid not found!";
}
$comments = getComments($_GET["gridId"]);
?>
    <div id="grid">
        <?php include "grid.php"?>
    </div>
    <div class="commentsContainer">
        <?php
        if(count($comments)== 0){
            echo "No Comments Yet!";
        } else {
            for ($i = 0; $i < count($comments); $i++) {
                include "Comments.php";
            }
        }
        ?>
    </div>
<div class="NewCommentClick">New Comment</div>
<div class="hide">Hide</div>
    <div class="addCommentContainer">
        <form class="addCommentForm" method="post">
            <input type="hidden" name="gridId" value="<?= $_GET["gridId"]?>">
            <label for="commentString">Your Comment:
                <textarea name="commentString"></textarea>
            </label>
            <button type="submit" name="submit">Add Comment</button>
        </form>
    </div>
<script src="commentSys.js"></script>
<?php include "footer.php" ?>