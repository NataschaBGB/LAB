<?php

    include_once("./connect.inc.php");
    
    session_start();

    $listname= $_POST['listname'];
    $userid = $_SESSION['userId'];

    $sql = "INSERT INTO `lists` (`listId`, `listName`, `userId`) VALUES (?, ?, ?);";
    
    $stmt = $conn->prepare($sql);

    $stmt->execute([NULL, $listname, $userid]);

    // $dbh = NULL;
    

    header("location: ../memberprofile.php");
