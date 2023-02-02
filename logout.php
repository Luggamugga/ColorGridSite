<?php
include "header.php";
if(isset($_SESSION)){
    logout();
    echo "<div class='success'>You've logged out</div>";
}
?>
<div class="successNav"></div><div class="homeLink"><a href="index.php">Home</a></div>
