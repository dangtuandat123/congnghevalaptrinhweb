<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000"><!-- gioi han file upload - don vi la byte -->
        <label>Upload
            <input type="file" name="ufile" id="ufile" />
        </label>
        <p>
            <input type="submit" name="upload" id="upload" value="Up load" />
        </p>
    </form>
    <?php
    // folder de up file len
    $target_path = "uploads/";
    if (isset($_FILES['ufile'])) {
        $target_path = $target_path . basename($_FILES['ufile']['name']);
        //VD: C:/images/abc.jpg
        //echo "<br>type:".$_FILES['ufile']['type'];
        //kiem tra kieu file upload
        if (!preg_match('/\.(jpg|gif|png)$/i', basename($_FILES['ufile']['name']))) {
            echo "Khong phai file anh!";
        } else
            // xu ly trung ten
            if (file_exists($target_path)) {
                echo basename($_FILES['ufile']['name']) . " already exists. ";
            } else if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target_path)) {
                echo "The file " . basename($_FILES['ufile']['name']) . " has been uploaded";
            } else {
                echo "There was an error uploading the file, please try again!";
            }
    }
    ?>
</body>

</html>