<?php
$so_phan_tu = filter_input(INPUT_POST, 'so_phan_tu');
$so_phan_tu = htmlspecialchars($so_phan_tu);
if (is_numeric($so_phan_tu)) {
    $array = [];

    for ($i = 0; $i < $so_phan_tu; $i++) {
        $array[] = rand(1, 99);
    }
    $max = max($array);
    $min = min($array);
    $sum = array_sum($array);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            text-align: left;
        }

        input {
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>PHÁT SINH MẢNG VÀ TÍNH TOÁN</h1>
    <FORm method="post" action=".">

        <table>
            <tr>
                <th>
                    <label for="">Nhập số phần tử</label>
                </th>
                <th><input type="text" name="so_phan_tu" value="<?php if (is_numeric($so_phan_tu)) echo $so_phan_tu ?>"></th>
            </tr>
            <tr>
                <th></th>
                <th><input type="submit" value="Phát sinh và tính toán"></th>
            </tr>
            <tr>
                <th><label for="">MẢNG</label></th>
                <th><input type="text" disabled value="<?php if (is_numeric($so_phan_tu)) for ($i = 0; $i < $so_phan_tu; $i++) {
                                                            echo $array[$i] . " ";
                                                        } ?>"></th>
            </tr>
            <tr>
                <th><label for="">Max</label></th>
                <th><input type="text" disabled value="<?php if (is_numeric($so_phan_tu)) echo $max ?>"></th>
            </tr>
            <tr>
                <th><label for="">Min</label></th>
                <th><input type="text" disabled value="<?php if (is_numeric($so_phan_tu)) echo $min ?>"></th>

            </tr>
            <tr>
                <th><label for="">Tổng mảng</label></th>
                <th><input type="text" disabled value="<?php if (is_numeric($so_phan_tu)) echo $sum ?>"></th>
            </tr>

        </table>




    </FORm>

</body>

</html>