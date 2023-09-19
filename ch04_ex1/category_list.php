<?php
require_once('database.php');

// Get all categories
$query = 'SELECT * FROM categories
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
var_dump($categories)
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
        <h1>Product Manager</h1>
    </header>
    <main>
        <h1>Category List</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($categories as $danhmuc) { ?>
                <form action="delete_category.php" method="post">
                    <tr>
                        <th><?php echo $danhmuc['categoryName'] ?></th>
                        <!-- $danhmuc['categoryID'] lấy cột categoryID -->
                        <th><input type="hidden" value="<?php echo $danhmuc['categoryID'] ?>" name="delete">
                            <input type="submit" value="Delete">
                        </th>
                    </tr>
                </form>
            <?php }; ?>
            <!-- add code for the rest of the table here -->

        </table>

        <h2>Add Category</h2>

        <!-- add code for the form here -->
        <form action="add_category.php" method="post">

            <label for="">Name </label>
            <input type="text" name="nameCategory">
            <input type="submit" value="Add">

        </form>

        <br>
        <p><a href="index.php">List Products</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>

</html>