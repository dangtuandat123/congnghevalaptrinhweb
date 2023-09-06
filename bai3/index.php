<?php

if (isset($_POST["nhapSo"])) {

    $nhapSo = $_POST["nhapSo"];
    switch ($_POST["nhapSo"]) {
        case 0;
            $ketQua = "Không";
            break;
        case 1;
            $ketQua = "Một";
            break;
        case 2;
            $ketQua = "Hai";
            break;
        case 3;
            $ketQua = "Ba";
            break;
        case 4;
            $ketQua = "Bốn";
            break;
        case 5;
            $ketQua = "Năm";
            break;
        case 6;
            $ketQua = "Sáu";
            break;
        case 7;
            $ketQua = "Bảy";
            break;
        case 8;
            $ketQua = "Tám";
            break;
        case 9;
            $ketQua = "Chín";
            break;
        default:
            $ketQua = "Nhập sai";
            break;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html {
            text-align: left;
            font-size: 30px;
            font-family: Arial, Helvetica, sans-serif;
        }

        th {
            border: 1px solid black;
            padding: 10px;
        }

        input {
            width: 175px;
            font-size: 30px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .input {
            text-align: center;
        }

        table {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <form action="index.php" method="post">
        <table>
            <tr>
                <th colspan="3">Đọc số</th>
            </tr>
            <tr>
                <th>Nhập số(0-9)</th>
                <th rowspan="2"><input type="submit"></th>
                <th>Bằng chữ</th>
            </tr>
            <tr>
                <th class="input"><input type="text" value="<?php echo $nhapSo ?>" name="nhapSo"></th>
                <th class="input"><input type="text" value="<?php echo $ketQua ?>"></th>
            </tr>
        </table>
    </form>
</body>

</html>