<?php
$op=$_GET["chon"];
if($op!=""){
include("database.class.php");
$dao=new Dao("root","","sinhvien");
$sql="select * from {$op}";
$header="DANH SÁCH {$op}";
$dao->table($sql,$header);
}
?>