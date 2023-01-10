<?php
    include_once "header.php";
?>

<body>

    <main>

    <?php
    if (isset($_SESSION["userUid"])) {
            echo "<p> Welcome " . $_SESSION["userUid"] . "</p>";
            ?>
        <?php
        }
        ?>

    </main>

    <?php
        include_once "footer.php";
    ?>
</body>