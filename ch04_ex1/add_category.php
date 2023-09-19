<?php
$nameCategory = filter_input(INPUT_POST, "nameCategory");
if ($nameCategory != false) {

    require_once("database.php");
    $queryCategoryAdd = "INSERT INTO `my_guitar_shop1`.`categories` (`categoryName`) VALUES (:nameCategory);";
    $statement = $db->prepare($queryCategoryAdd);
    $statement->bindValue(':nameCategory', $nameCategory);
    $statement->execute();
    $statement->closeCursor();
    include("category_list.php");
} else {

?>


    <!DOCTYPE html>
    <html>

    <!-- the head section -->

    <head>
        <title>My Guitar Shop</title>
        <link rel="stylesheet" type="text/css" href="main.css" />
    </head>

    <!-- the body section -->

    <body>
        <header>
            <h1>My Guitar Shop</h1>
        </header>

        <main>
            <h2 class="top">Error</h2>
            <p>Invalid category data. Check all fields and try again.</p>
        </main>

        <footer>
            <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
        </footer>
    </body>

    </html>


<?php } ?>