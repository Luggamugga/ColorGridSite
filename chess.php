<?php
include "header.php";
?>
<link rel="stylesheet" href="chessStyle.css">
<div class="chessMain">
    <div class="chessTitle">
        Play Chess!
    </div>
    <div class="turnSignalWhite"></div>
    <div class="chessGrid">
        <?php include "ChessGrid.php" ?>
    </div>
    <div class="turnSignalBlack"></div>
    <div class="chessButts">
        <div class="chessMsg"></div>
    </div>
</div>
    <script src="chess.js"></script>

<?php
include "footer.php";
?>