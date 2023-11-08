<!DOCTYPE html>
<html>

<head>
    <title>Rating</title>
    <meta charset="utf-8">
    <link href="template/css.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div id="container">
        <header>
            <h1><a href="index.php">COMPUTER ABC</a></h1>
        </header>
        <div id="main-wrapper">
            <div id="product-info">
                <?php echo $html ?>
            </div>
            <div id="rating">
                <form action="" method="POST">
                    <h3>Đánh giá</h3>
                    <input type="radio" name="rate" value="5" checked> 5
                    <input type="radio" name="rate" value="4"> 4
                    <input type="radio" name="rate" value="3"> 3
                    <input type="radio" name="rate" value="2"> 2
                    <input type="radio" name="rate" value="1"> 1<br />
                    <input type="submit" name="rate_submit" value="Rate" id="submit-button">
                </form>
            </div>
        </div>
        <footer>
        </footer>
    </div>
</body>

</html>