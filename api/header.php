<!DOCTYPE html>
<html lang="en/EN">
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<div class="header"><h1>WELCOME TO 192 BYTES</h1></div>
<div class="navigation">
    <ul class="NavList">
        <li class="HomeNav"><a href="index.php">Home</li>
        <li class="createNav"><a href="create.php">Create a Grid!</a></li>
        <li class="chessNav"><a href="chess.php">Chess</a></li>
        <li class="chatNav"><a href="anonchat.php">Chat</a></li>
        <?php if(isset($_SESSION["userid"])):?>
        <li class="PersonalNav"><a href="Profile.php?usr=<?=$_SESSION['userid'] ?>">My Page</a></li>
        <?php endif;?>
        <?php if (!isset($_SESSION["usrname"]) && !isset($_POST["registered"])): ?>
            <li class="RegisterNav"><a href="register.php">Register</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION["usrname"])): ?>
            <li class="logoutNav"><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li class="LoginNav"><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</div>
