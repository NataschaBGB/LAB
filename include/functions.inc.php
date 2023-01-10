<?php

    function emptyInputSignup($name, $email, $username, $pw, $pwrepeat) {
        
        $result;

        if (empty($name) || empty($email) || empty($username) || empty($pw) || empty($pwrepeat)) {
            $result = true;
        } 
        else {
            $result = false;
        }
        return $result;
    }

    function invalidUid($username) {
        
        $result;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $result = true;
        } 
        else {
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email) {
        
        $result;
        // checks if email actually exists
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } 
        else {
            $result = false;
        }
        return $result;
    }

    function pwMatch($pw, $pwrepeat) {
        
        $result;

        if ($pw !== $pwrepeat) {
            $result = true;
        } 
        else {
            $result = false;
        }
        return $result;
    }

    function uidExists($conn, $username, $email) {
        
        $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../newuser.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $name, $username, $email, $pw) {
        
        $sql = "INSERT INTO users (userName, userUid, pw, userEmail) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../newuser.php?error=stmtfailed");
            exit();
        }

        $hashedPw = password_hash($pw, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $hashedPw, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../newuser.php?error=none");
    }

    function emptyInputLogin($username, $pw) {
        
        $result;

        if (empty($username) || empty($pw)) {
            $result = true;
        } 
        else {
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $username, $pw) {

        $uidExists = uidExists($conn, $username, $username);

        if ($uidExists === false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }

        $pwHashed = $uidExists["pw"];
        $checkPw = password_verify($pw, $pwHashed);

        if ($checkPw === false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }
        else if ($checkPw === true) {
            session_start();
            $_SESSION["userId"] = $uidExists["userId"];
            $_SESSION["userUid"] = $uidExists["userUid"];
            header("location: ../memberprofile.php");
            exit();
        }

    }