
<?php
include("./inc/connect.inc");
$lop = $_GET['lop'];
$sql = "SELECT * FROM sinhvien WHERE lop='{$lop}'";
$rs = mysqli_query($con, $sql);

$str = "<table>
<tr class=hd>
<td>TT</td>
<td>Mã số</td>
<td>Họ tên</td>
<td>Địa chỉ</td>
</tr>";
$tt = 1;

$str2 = "";
while ($row = mysqli_fetch_array($rs)) {
    $str2 = "<tr>
<td>{$tt}</td>
<td>{$row['masv']}</td>
<td>{$row['hoten']}</td>
<td>{$row['diachi']}</td>
</tr>" . $str2;
    $tt++;
}
$str =  $str.$str2. "</table>";
echo $str;
