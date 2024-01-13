<?php
include "mysqlFunctions.php";
 include "header.php";
 ?>
<div class="profTitle">
    <?php if ($_SESSION["userid"] == $_GET["usr"]){
        echo "Your Profile";
    } else {
        echo getUserbyId($_GET["usr"])."'s Profile";
    }?>
</div>
<div class="gridsDiv">
<?php getGridsByUsrId($_GET["usr"]);
?>
</div>
<div class="backTop"><a href="">Back to Top</a></div>
<script src="likesSystem.js"></script>
