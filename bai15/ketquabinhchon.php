<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <body>
        <table width="450" border="1" cellpadding="4">
            <?php

            require_once("./config.php");
            $s = "select * from binhchon where idBC=1";
            $kq = mysqli_query($config, $s);
            if ($d = mysqli_fetch_array($kq)) {
                $mota = $d["MoTa"];
            }
            $s = "select sum(SoLanChon) as tongsolanchon from phuongan where idBC=1";
            $kq = mysqli_query($config, $s);
            if ($d = mysqli_fetch_array($kq))
                $tongsobinhchon = $d["tongsolanchon"];
            ?>
            <tr>
                <td colspan="3" bgcolor="#66CCFF" align="center"><?php echo $mota;
                                                                    ?></td>
            </tr>
            <?php
            $s = "select * from phuongan where idBC=1";
            $kq = mysqli_query($config, $s);
            while ($d = mysqli_fetch_array($kq)) {
                $rong = ($d["SoLanChon"] / $tongsobinhchon) * 150;
                $phantram = ($d["SoLanChon"] / $tongsobinhchon) * 100;
            ?>
                <tr>
                    <td width="150"><?php echo $d["MoTa"]; ?></td>
                    <td width="150">
                        <table width="150">

                            <tr>
                                <td width="<?php echo $rong; ?>" bgcolor="#FF0000"></td>
                                <td><?php echo round($phantram, 2); ?>%</td>
                            </tr>
                        </table>
                    </td>
                    <td width="150">So lan chon: <?php echo $d["SoLanChon"]; ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="3" align="right">Tong so lan chon: <?php echo $tongsobinhchon;
                                                                ?></td>
            </tr>
        </table>
    </body>

</html>