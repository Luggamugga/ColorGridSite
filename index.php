
<?php
include "mysqlFunctions.php";
if(isset($_GET["delId"])){
    deleteGrid($_GET["delId"]);
    header("Location: index.php");
    echo "deleted";
}
include "header.php";
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        let scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>
<div class="gridsDiv">
<?php
getAllGrids();
?>

</div>
<div class="backTop"><a href="">Back to Top</a></div>
<script src="likesSystem.js"></script>

<?php include "footer.php" ?>
