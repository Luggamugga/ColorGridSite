<?php
include "mysqlFunctions.php";
include "header.php" ;
?>
<div id="grid">
    <?php
    $row;
    if (isset($_SESSION['userid']) && isset($_GET['gridId'])) {
        $row = getGridById($_GET["gridId"]);
        $array = json_decode($row["grid"], true);
        if ($row["userId"] == $_SESSION["userid"]) {
            include "grid.php";
        }
    } else {
        include "blankGrid.php";
    }
    ?>
</div>
<div id="colors">
    <div id="white" class="colorBox"></div>
    <div id="black" class="colorBox"></div>
    <div id="yellow" class="colorBox"></div>
    <div id="orange" class="colorBox"></div>
    <div id="red" class="colorBox"></div>
    <div id="darkred" class="colorBox"></div>
    <div id="lightblue" class="colorBox"></div>
    <div id="blue" class="colorBox"></div>
    <div id="darkblue" class="colorBox"></div>
    <div id="purple" class="colorBox"></div>
    <div id="green" class="colorBox"></div>
</div>
<div class="InputDiv">
    <input type="text" id="colorInput">
    <button type="button" id="colorButt">Add Color</button>
</div>
<div class="GridSubButts">
    <div class="resetColorsButt">
        <button onclick="resetColors()">Reset colors</button>
    </div>
    <div class="resetGridButt">
        <button onclick="resetGrid()">Reset Grid</button>
    </div>
    <div class="lockButt">
        <button onclick="gridLock()" id="lockButt">Lock Grid</button>
    </div>
    <div class="createRand">
        <button onclick="createRandomGrid()">Create Random Grid</button>
    </div>
    <form method="post" id="saveForm">
        <div id="parent">
        </div>
        <?php if (isset($_SESSION["userid"])): ?>
            <div class="saveButt"><input type="submit" value="Save Grid to Your Account"
                                         onclick="getColorsGrid();gridLock()">
            </div>
        <?php else: ?>
            <div class="note"><a href="register.php">Register</a> or <a href="login.php">Login</a> to save</div>
        <?php endif; ?>
    </form>
</div>
<?php
if (!empty($_POST)) {
    if ($row["userId"] == $_SESSION["userid"]) {
        editGrid($row["id"], $_POST, $row["userId"]);
        echo "You're grid was editted!";
    } else {
        saveGrid($_SESSION["userid"], $_POST);
        echo "You're grid was saved!";
        $saved = true;
    }

}
?>
<script src="script.js"></script>
<?php include "footer.php" ?>
