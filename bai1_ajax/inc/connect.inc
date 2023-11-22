<?php
$server=$_SERVER['SERVER_NAME'];
$user="root";
$pass="";
$db="sinhvien";
$con=mysqli_connect($server,$user,$pass,$db);
mysqli_query($con,"set names 'utf8'");
?>