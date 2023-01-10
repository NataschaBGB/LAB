<head>
    <title>My List | List Items</title>
</head>

<body>

    <?php
        include_once "header.php";
    ?>

    <main>

    <div class="memberprofile">
        <div class="memberheader">
            <?php 
                if (isset($_SESSION["userId"])) {
                    echo "<h2>" . $_SESSION["userUid"] . "</h2>";
                }
            ?>
        </div>
    </div>

    <?php 
            if (isset($_SESSION["userUid"])) {
                ?>
                 <form action='include/insertitem.inc.php' method='post' class='new'>
                    <div class='lbl'>
                        <label for='itemName'>List Item</label>
                            <input type='text' name='itemname' required placeholder="Item name...">
                        </div>
                    </div>
                    <div>
                        <input class='btn' type='submit'>
                    </div>
                </form>
            <?php
            }
            
            
            include_once("include/connect.inc.php");
            
            // select column listName from table lists, where the listId in listitems matches the lidtId in lists.
            $sql = "SELECT listitems.* FROM listitems JOIN lists WHERE listitems.listId = lists.listId;";
            $stmt = $conn->prepare($sql);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
    

            // while there is still rows in the lists table
            // fetch the associative array from the database, where the listName is stored
            while($row = mysqli_fetch_assoc($resultData))
            {?>
                <!-- and show the listName if its userId matches the userId of the logged in user -->
                <article class="listitems">
                    <p><?php echo $row['itemName'];?></p>
                </article>
            <?php
                }
            ?>


    </main>

<?php
    include_once "footer.php";
?>
</body>
</html>