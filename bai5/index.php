<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        th {
            border: 1px solid black;
            padding: 5px;
            text-align: left;

        }

        .input {
            width: 50px;

        }

        table {
            border: 1px solid black;
        }

        * {
            white-space: nowrap;
            font-size: 25px;
            font-family: Arial, Helvetica, sans-serif;

        }
    </style>
</head>

<?php
try {
    if (filter_input(INPUT_POST, "a") && filter_input(INPUT_POST, "b") && filter_input(INPUT_POST, "c")) {
        $a = filter_input(INPUT_POST, "a");
        $b = filter_input(INPUT_POST, "b");
        $c = filter_input(INPUT_POST, "c");

        $denta = ($b) * ($b) - (4 * $a * $c);
        if ($denta < 0) {
            $nghiem = "Vô nghiệm";
        } else if ($denta == 0) {

            $nghiem = "Nghiệm kép: " . -1 * ($b / (2 * $a));
        } else if ($denta > 0) {

            $nghiem = "X1: = " . (((-1) * $b) + sqrt($denta)) / (2 * $a) . ", X2: = " . (((-1) * $b) - sqrt($denta)) / (2 * $a);
        }
    }
} catch (\Throwable $th) {
    $nghiem = "Vui lòng nhập đúng";
}


?>

<body>
    <form action="index.php" method="post">
        <table>
            <tr>
                <th colspan="4">Giải phương trình bậc 2</th>
            </tr>
            <tr>
                <th>Phương trình</th>
                <th>
                    <input type="text" class="input" name="a">
                    <label for="">X<sup>2</sup> + </label>
                </th>
                <th>
                    <input type="text" class="input" name="b">
                    <label for="">X +</label>
                </th>
                <th> <input type="text" class="input" name="c">
                    <label for="">= 0</label>
                </th>
            </tr>
            <tr>
                <th colspan="4">Nghiệm <input type="text" value="<?php if (filter_input(INPUT_POST, "a") && filter_input(INPUT_POST, "b") && filter_input(INPUT_POST, "c")) echo $nghiem ?>"></th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;"><input type="submit" value="Xuất"></th>
            </tr>

        </table>
    </form>
</body>

</html>