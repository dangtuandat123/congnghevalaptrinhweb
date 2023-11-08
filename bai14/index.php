<?php
session_start();
if (isset($_POST['submit'])) {
    $input = $_POST['input'];
    if ($input == $_SESSION['captcha'])
        $_SESSION['message'] = "* Right captcha !!!";
    else {
        $_SESSION['message'] = "* Wrong captcha !!!";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>CAPTCHA</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: #ecf0f1;
        }

        a:link,
        a:visited {
            color: #2980b9;
            text-decoration: none;
        }

        a:hover,
        a:active {

            text-decoration: underline;
            color: #e74c3c;
        }

        form {
            width: 450px;
            margin: 20px auto;
            border: 1px solid #95a5a6;
            border-radius: 5px;
            background: #fff;
            padding: 20px;
        }

        form input[type="text"] {
            width: 200px;
            height: 48px;
            padding: 0;
            margin: 0;
            float: left;
            border: 1px solid #2c3e50;
            margin-right: 10px;
            border-radius: 5px;
        }

        form input[type="submit"] {
            padding: 5px 20px;
        }

        #message {
            color: #c0392b;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <h2>CAPTCHA - WEB</h2>
        <p>Please enter the captcha:</p>
        <input type="text" name="input"><img src="captcha.php" title="" alt="" /><br />
        <input type="submit" name="submit" value="Send">
        <p id="message"><?php if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        } ?></p>
    </form>
</body>

</html>