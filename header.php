<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>My List</title>
</head>

<header>
        <div class="logo">
            <img src="./img/Logo.png" alt="My List Logo">
        </div>
        <nav>
            <ul>
                <a href="index.php"><li>Front Page</li></a>
                <a href="contact.php"><li>Contact Us</li></a>

                <?php 
                    if (isset($_SESSION["userUid"])) {
                        echo "<a href='memberprofile.php'><li>Profile</li></a>";
                        echo "<a href='include/logout.inc.php'><li>Log out</li></a>";
                    }
                    else {
                        echo "<a href='newuser.php'><li>Create New User</li></a>";
                        echo "<a href='login.php'><li>Login</li></a>";
                    }
                ?>
            </ul>
        </nav>
    </header>