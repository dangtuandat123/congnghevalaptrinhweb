<?php include '../view/header.php'; ?>
<?php
require_once('../model/database.php');
require_once('../model/category_db.php');
$categorys = get_categories();
?>
<main>

    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <!-- add category rows here -->
        <form action="index.php" method="post">
            <?php foreach ($categorys as $category) { ?>
                <tr>
                    <th><?php echo $category['categoryName'] ?></th>
                    <th>
                        <input type="hidden" name="categoryDelete" value="<?php echo $category['categoryID'] ?>">
                        <input type="hidden" name="action" value="detele_category">
                        <input type="submit"  value="Delete">
                    </th>
                </tr>
            <?php } ?>
        </form>
    </table>

    <h2>Add Category</h2>
    <!-- add code for form here -->
    <form action="index.php" method="post">
        <label for="">Name</label>
        <input type="text" name="name_category">
        <input type="hidden" name="action" value="add_category">
        <input type="submit" value="ADD">
    </form>

    <p><a href="index.php?action=list_products">List Products</a></p>

</main>
<?php include '../view/footer.php'; ?>