<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        th {
            border: 1px solid black;
            padding: 5px 10px 5px 5px;
        }

        table {
            border: 1px solid black;
        }

        * {
            text-align: left;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            white-space: nowrap;
        }

        input {
            border: 1px solid rgb(189, 179, 179);
        }
    </style>
</head>
<?php
if (filter_input(INPUT_POST, "soBatDau") && filter_input(INPUT_POST, "soKetThuc")) {
$soBatDau = filter_input(INPUT_POST, "soBatDau");
$soKetThuc = filter_input(INPUT_POST, "soKetThuc");
$tongCacSo = 0;
$tichCacSo = 1;
$tongCacSoChan = 0;
$tongCacSoLe = 0;
for ($i = $soBatDau; $i <= $soKetThuc; $i++) {
    $tongCacSo = $tongCacSo + $i;
    $tichCacSo = $tichCacSo * $i;
    if ($i % 2 == 0) {
        $tongCacSoChan += $i;
    } else {
        $tongCacSoLe += $i;
    }
}
}
?>

<body>
    <form action="index.php" method="post">
        <table>
            <tr>
                <th></th>
                <th>Số bắt đầu</th>
                <th><input type="text" name="soBatDau"></th>
                <th>Số kết thúc</th>
                <th><input type="text" name="soKetThuc"></th>
            </tr>

            <tr>
                <th colspan="5">Kết quả</th>
            </tr>
            <tr>
                <th>Tổng các số</th>
                <th colspan="4"><input type="text" value="<?php if (filter_input(INPUT_POST, "soBatDau") && filter_input(INPUT_POST, "soKetThuc")) echo $tongCacSo ?>"></th>
            </tr>
            <tr>
                <th>Tích các số</th>
                <th colspan="4"><input type="text" value="<?php if (filter_input(INPUT_POST, "soBatDau") && filter_input(INPUT_POST, "soKetThuc")) echo $tichCacSo ?>"></th>
            </tr>
            <tr>
                <th>Tổng các số chẵn</th>
                <th colspan="4"><input type="text" value="<?php if (filter_input(INPUT_POST, "soBatDau") && filter_input(INPUT_POST, "soKetThuc")) echo $tongCacSoChan ?>"></th>
            </tr>
            <tr>
                <th>Tổng các số lẻ</th>
                <th colspan="4"><input type="text" value="<?php if (filter_input(INPUT_POST, "soBatDau") && filter_input(INPUT_POST, "soKetThuc")) echo $tongCacSoLe ?>"></th>
            </tr>
            <tr>
                <th colspan="5"><input type="submit" value="Tính toán"></th>
            </tr>
        </table>
    </form>
</body>

</html>