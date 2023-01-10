<head>
    <title>My List | Member Profile</title>
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
        include_once("include/connect.inc.php");
        
        // select column listName from table lists, where the userId matches the logged in userId
        $sql = "SELECT listName FROM lists WHERE userId = '$_SESSION[userId]';";
        $stmt = $conn->prepare($sql);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);


        
        if (isset($_SESSION["userUid"])) {
            ?>
             <form action='include/insert.inc.php' method='post' class='new'>
                <div class='lbl'>
                    <label for='listName'>List Name</label>
                    <div class='input'>
                        <input type='text' name='listname' required>
                    </div>
                </div>
                <div>
                    <input class='btn' type='submit'>
                </div>
            </form>
        <?php
        }
        

        // while there is still rows in the lists table
        // fetch the associative array from the database, where the listName is stored
        while($row = mysqli_fetch_assoc($resultData))
        {?>
            <!-- and show the listName if its userId matches the userId of the logged in user -->
            <article class="lists">
                <a href='listitems.php?<?php echo $row['listName']?>'><?php echo $row['listName'];?></a>
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