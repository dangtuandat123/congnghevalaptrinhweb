<?php
if (isset($_POST["a"]) && isset($_POST["b"])) {
    $a = $_POST["a"];
    $b = $_POST["b"];
    if ($a == 0) {
        if ($b == 0)
            $nghiem = "Phương trình có vô số nghiệm";
        if ($b <> 0)
            $nghiem = "Phương trình vô nghiệm";
    } else {
        $x = - ($b / $a);
        $x = round($x, 2);
        $nghiem = "x= $x";
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
            font-size: 20px;
            font-family: Arial, Helvetica, sans-serif;
            white-space: nowrap;
        }

        th {
            border: 1px double black;
            text-align: left;
            
        }

        table {
            border: 1px solid black;
        }
        input{
            font-size: 20px;
            width: 100px
        }
    </style>
</head>


<body>
    <form action="index.php" method="post">
        <table>
            <tr>
                <th colspan="2" style="background-color: rgb(46, 123, 255)">Giải phương trình bậc 1</th>

            </tr>
            <tr>
                <th>
                    phương trình <input type="text" name="a" value="<?php if(isset($_POST["a"])&&(isset($_POST["b"]))) echo $a ?>">
                </th>
                <th>
                    X+ <input type="text" name="b" value="<?php if(isset($_POST["a"])&&(isset($_POST["b"]))) echo $b ?>">
                    = 0
                </th>
            </tr>
            <tr>
                <th colspan="2">Nghiệm <input type="text" value="<?php if(isset($_POST["a"])&&(isset($_POST["b"]))) echo $nghiem ?>"> </th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: center;"><input type="submit" value="Xuất"></th>

            </tr>
        </table>
    </form>
</body>

</html>