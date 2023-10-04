<?php
$mang = filter_input(INPUT_POST, 'mang');
$mang = htmlspecialchars($mang);
if (!empty($mang)) {
    $array =  explode(",", $mang);
    $counts = array_count_values($array);
    $unique_numbers = array_unique($array, SORT_REGULAR);

    
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
    <h1>ĐẾM SỐ LẦN XUẤT HIỆN VÀ TẠO MẢNG DUY NHẤT</h1>
    <form action="." method="post">
        <TAble>
            <TR>
                <th><laBel>MẢNG</laBel></th>
                <th><input type="text" name="mang" value="<?php if (!empty($mang)) echo $mang?>"></th>

            </TR>
            <TR>
                <th><label for="">SỐ LẦN XUẤT HIỆN</label></th>
                <th><input type="text" disabled value="<?php if (!empty($mang)) foreach ($counts as $key => $value) {
                                                            echo "$key:$value ";
                                                        } ?>"></th>
            </TR>
            <TR>
                <th><label for="">MẢNG DUY NHẤT</label></th>

                <th><input type="text"  value="<?php if (!empty($mang)) foreach ($counts as $key => $value) {
                                                            echo "$key ";
                                                        } ?>" disabled></th>

            </TR>
            <TR>

                <th colspan="2"><input type="submit" value="THỰC HIỆN"></th>

            </TR>

        </TAble>
    </form>
</body>

</html>