<?php

    include_once("./connect.inc.php");
    include_once("./functions.inc.php");
    
    session_start();


    $itemname= $_POST['itemname'];
    $userid = $_SESSION['userId'];
    // this needs to match the listId from table lists to the listId from table listitems. How???
    $listid = "SELECT listitems.* FROM listitems JOIN lists ON listitems.listId = lists.listId;";

    $sql = "INSERT INTO `listitems` (`itemId`, `itemName`, `userId`, `listId`) VALUES (?, ?, ?,?);";
    
    $stmt = $conn->prepare($sql);

    $stmt->execute([NULL, $itemname, $userid, $listid]);

    // $dbh = NULL;
    

    header("location: ../listitems.php");