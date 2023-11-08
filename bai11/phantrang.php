<?php
$conn = mysqli_connect("localhost", "root", "", "bai11");
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 10; // 10 title per page
$start = ($page - 1) * $limit;
$total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tintuc"));
$total_page = $total_title / $limit;
$query = "SELECT * FROM tintuc LIMIT " . $start . ", " . $limit;
$result = mysqli_query($conn, $query);
echo "<div class=\"title\">";
while ($row = mysqli_fetch_array($result)) {
    echo '<a href="#">' . $row['id'] . '. ' . $row['title'] . '</a><br />';
}

"</div>";
echo "<div class=\"pagination\">";
for ($i = 1; $i <= $total_page; $i++) {
    echo '<a href="phantrang.php?page=' . $i . '">' . $i . '</a> | ';
}
echo "</div>";
?>
<style type="text/css">
    body {
        background: #ecf0f1;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    a:link,
    a:visited {
        text-decoration: none;
    }

    a:hover {
        color: #f00;
    }

    .title,
    .pagination {
        width: 600px;
        margin: 0 auto;
        margin-bottom: 20px;
    }

    .title {
        background: #349233;
        padding: 20px;
        line-height: 1.5;
    }

    .title a {
        color: #fff;
    }

    .title a:hover {
        color: #e67e22;
    }
</style>