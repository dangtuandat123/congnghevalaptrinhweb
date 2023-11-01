<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
    <script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
</head>

<body>
    <form action="_posteddata.php" method="post">
        <textarea name="description" id="editor1" rows="10" cols="80"></textarea>
        <script type="text/javascript">
            CKEDITOR.replace('editor1');
        </script>
        <input name="ok" type="submit" value="Ok" />
    </form>
</body>

</html>