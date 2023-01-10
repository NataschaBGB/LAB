<?php

    if (isset($_POST["submit"])) {
        
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["userUid"];
        $pw = $_POST["pw"];
        $pwrepeat = $_POST["pwrepeat"];

        require_once "connect.inc.php";
        require_once "functions.inc.php";

        // if function is not equal to false
        if (emptyInputSignup($name, $email, $username, $pw, $pwrepeat) !== false) {
            // send user back to the sign up page with an error message that says they forgot to write something in an input field
            header("Location: ../newuser.php?error=emptyinput");
            exit();
        }

        // if username is invalid
        if (invalidUid($username) !== false) {
            // send user back to the sign up page with an error message
            header("Location: ../newuser.php?error=invaliduid");
            exit();
        }

        // if email is invalid
        if (invalidEmail($email) !== false) {
            // send user back to the sign up page with an error message
            header("Location: ../newuser.php?error=invalidemail");
            exit();
        }

        // if passwords doesnt match
        if (pwMatch($pw, $pwrepeat) !== false) {
            // send user back to the sign up page with an error message
            header("Location: ../newuser.php?error=passwordsdoesntmatch");
            exit();
        }

        // if username or email is invalid/ already exists
        if (uidExists($conn, $username, $email) !== false) {
            // send user back to the sign up page with an error message
            header("Location: ../newuser.php?error=usernameoremailtaken");
            exit();
        }

        createUser($conn, $name, $username, $email, $pw);

    }
    else {
        header("Location: ../newuser.php");
        // exit() to make sure the script stops
        exit();
    }