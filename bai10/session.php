<?php
session_start();
if(!isset($_SESSION['name']))
{
$_SESSION['name']="phuc";
$_SESSION['age']=18;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Session</title>
</head>
<body>
<?php
echo "Tên bạn là:". $_SESSION['name']."<br/>";
echo "Số tuổi của bạn:".$_SESSION['age']."<br/>";
?>
<a href="test_session.php">Click here!</a>
</body>
</html>