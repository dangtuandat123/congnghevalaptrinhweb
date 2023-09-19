<?php
    $danhMucCanXoa = filter_input(INPUT_POST, "delete");

    require_once('database.php');

    echo $danhMucCanXoa;
    $queryCategoryDelete = "DELETE FROM `my_guitar_shop1`.`categories` WHERE  `categoryID`= :categoryID";
    $statement = $db->prepare($queryCategoryDelete);
    $statement->bindValue(':categoryID', $danhMucCanXoa);
    $success = $statement->execute();
    $statement->closeCursor();
    include("category_list.php");
?>