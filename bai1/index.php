<?php
if (isset($_POST["ten"])) {
    if ($_POST["ten"] == "") {
        $ten = "Bạn chưa nhập tên";
    } else {
        $ten = "Xin chào " . $_POST["ten"];
    };
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        html {
            font-size: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;

            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        tr {
            border: 2px solid black;
        }

        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top
        }
    </style>
</head>

<body>

    <form action="index.php" method="post">
        <table class="tg">
            <thead>
                <tr>
                    <th style="text-align: center; color: aqua; background-color: rgb(36, 36, 119);" class="tg-0pky" colspan="3">In lời chào</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tg-0pky">Họ và tên</td>
                    <td class="tg-0pky" colspan="2"> <input style="font-size: 20px;" type="text" name="ten"></td>
                </tr>
                <tr>
                    <td class="tg-0pky" colspan="3">
                        <label><?php echo $ten; ?></label>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" class="tg-0pky" colspan="3"><input type="submit" value="Xuất"></td>
                </tr>
            </tbody>
        </table>

    </form>

</body>

</html>