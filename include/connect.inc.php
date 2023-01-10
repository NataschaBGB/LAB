<?php 
    $serverName = "localhost";
    $dbName = "mylist";
    $dbusername = "root";
    $dbpassword = "";


    $conn = mysqli_connect($serverName, $dbusername, $dbpassword, $dbName);

    if(!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }


