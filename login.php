<head>
    <title>My List | Login</title>
</head>

<?php
    include_once "header.php";
?>

<body>

    <main>

    <form action="./include/login.inc.php" method="post" class="login">
            
            <h1>Log In</h1>

            <div class="loginform">
                <div class="lbl">
                    <label for="username">Username or email</label>
                    <div class="input">
                        <input type="text" name="uid">
                    </div>
                </div>

                <div class="lbl">
                    <label for="password">Password</label>
                    <div class="input">
                        <input type="password" name="pw" placeholder="Password">
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" name="submit">Log In</button>
            </div>
    
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p style=\"text-align:center;font-size:1.4rem;font-weight:bold;color:red;\">Error!</p>";
                        echo "<p style=\"text-align:center;font-size:1.2rem;font-weight:bold;color:red;\">- Please fill in all input fields!</p>";
                    }
                    else if ($_GET["error"] == "wronglogin") {
                        echo "<p style=\"text-align:center;font-size:1.2rem;font-weight:bold;color:red;\">- An error ocurred. User does not exist or password does not match. Please try again.</p>";
                    }
                }
            ?>
    
        </form>

    </main>

    <?php
        include_once "footer.php";
    ?>
</body>
</html>