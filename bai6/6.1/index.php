<?php
$day_so = filter_input(INPUT_POST, 'day_so');
$day_so = htmlspecialchars($day_so);
if (!empty($day_so)) {
    $array =  explode(",", $day_so);
    $tong = 0;
    for ($i = 0; $i < count($array); $i++) {
        $tong = $array[$i] + $tong;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>NHẬP VÀ TÍNH TRÊN DÃY SỐ</h1>
    <form action="." method="post">
        <label for="">Nhập dãy số</label>
        <input type="text" name="day_so">
        <br>
        <input type="submit" value="Tổng dãy số">
        <br>
        <label for="">Tổng dãy số</label>
        <input type="text" disabled value="<?php echo $tong ?>">

    </form>
</body>

</html>