<?php
function runSelectQuery($sql, $params = [])
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "doancoso2";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        $result = $statement->fetchAll();

        return $result;
    } catch (PDOException $e) {
        die("Lỗi truy vấn: " . $e->getMessage());
    }
}

$sql = "SELECT * FROM caidat";

$caidat = runSelectQuery($sql);
if ($caidat[0]['trangthai'] == "baotri") {
    if (isset($_SESSION['capbac'])) {
        if ($_SESSION['capbac'] != "admin") {
            echo '<!doctype html>
        <title>Đang bảo trì</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <style>
          html, body { padding: 0; margin: 0; width: 100%; height: 100%; }
          * {box-sizing: border-box;}
          body { text-align: center; padding: 0; background: #d6433b; color: #fff; font-family: Open Sans; }
          h1 { font-size: 50px; font-weight: 100; text-align: center;}
          body { font-family: Open Sans; font-weight: 100; font-size: 20px; color: #fff; text-align: center; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; align-items: center;}
          article { display: block; width: 700px; padding: 50px; margin: 0 auto; }
          a { color: #fff; font-weight: bold;}
          a:hover { text-decoration: none; }
          svg { width: 75px; margin-top: 1em; }
        </style>
        
        <article>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202.24 202.24"><defs><style>.cls-1{fill:#fff;}</style></defs><title>Asset 3</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M101.12,0A101.12,101.12,0,1,0,202.24,101.12,101.12,101.12,0,0,0,101.12,0ZM159,148.76H43.28a11.57,11.57,0,0,1-10-17.34L91.09,31.16a11.57,11.57,0,0,1,20.06,0L169,131.43a11.57,11.57,0,0,1-10,17.34Z"/><path class="cls-1" d="M101.12,36.93h0L43.27,137.21H159L101.13,36.94Zm0,88.7a7.71,7.71,0,1,1,7.71-7.71A7.71,7.71,0,0,1,101.12,125.63Zm7.71-50.13a7.56,7.56,0,0,1-.11,1.3l-3.8,22.49a3.86,3.86,0,0,1-7.61,0l-3.8-22.49a8,8,0,0,1-.11-1.3,7.71,7.71,0,1,1,15.43,0Z"/></g></g></svg>
            <h1>WEBSITE ĐANG BẢO TRÌ</h1>
            
            <div>
                <p>Xin lỗi vì sự bất tiện này, vui lòng quay lại trang web sau.</p>
               
            </div>
        </article>';
        } else {
            echo '<!doctype html>
        <title>Đang bảo trì</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <style>
          html, body { padding: 0; margin: 0; width: 100%; height: 100%; }
          * {box-sizing: border-box;}
          body { text-align: center; padding: 0; background: #d6433b; color: #fff; font-family: Open Sans; }
          h1 { font-size: 50px; font-weight: 100; text-align: center;}
          body { font-family: Open Sans; font-weight: 100; font-size: 20px; color: #fff; text-align: center; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; align-items: center;}
          article { display: block; width: 700px; padding: 50px; margin: 0 auto; }
          a { color: #fff; font-weight: bold;}
          a:hover { text-decoration: none; }
          svg { width: 75px; margin-top: 1em; }
        </style>
        
        <article>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202.24 202.24"><defs><style>.cls-1{fill:#fff;}</style></defs><title>Asset 3</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M101.12,0A101.12,101.12,0,1,0,202.24,101.12,101.12,101.12,0,0,0,101.12,0ZM159,148.76H43.28a11.57,11.57,0,0,1-10-17.34L91.09,31.16a11.57,11.57,0,0,1,20.06,0L169,131.43a11.57,11.57,0,0,1-10,17.34Z"/><path class="cls-1" d="M101.12,36.93h0L43.27,137.21H159L101.13,36.94Zm0,88.7a7.71,7.71,0,1,1,7.71-7.71A7.71,7.71,0,0,1,101.12,125.63Zm7.71-50.13a7.56,7.56,0,0,1-.11,1.3l-3.8,22.49a3.86,3.86,0,0,1-7.61,0l-3.8-22.49a8,8,0,0,1-.11-1.3,7.71,7.71,0,1,1,15.43,0Z"/></g></g></svg>
            <h1>WEBSITE ĐANG BẢO TRÌ</h1>
            
            <div>
            <p><a href="./index.php?controller=admin">Quay về trang quảng trị Admin</a></p>
               
            </div>
        </article>';
        }
    } else {
        echo '<!doctype html>
        <title>Đang bảo trì</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <style>
          html, body { padding: 0; margin: 0; width: 100%; height: 100%; }
          * {box-sizing: border-box;}
          body { text-align: center; padding: 0; background: #d6433b; color: #fff; font-family: Open Sans; }
          h1 { font-size: 50px; font-weight: 100; text-align: center;}
          body { font-family: Open Sans; font-weight: 100; font-size: 20px; color: #fff; text-align: center; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; align-items: center;}
          article { display: block; width: 700px; padding: 50px; margin: 0 auto; }
          a { color: #fff; font-weight: bold;}
          a:hover { text-decoration: none; }
          svg { width: 75px; margin-top: 1em; }
        </style>
        
        <article>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202.24 202.24"><defs><style>.cls-1{fill:#fff;}</style></defs><title>Asset 3</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M101.12,0A101.12,101.12,0,1,0,202.24,101.12,101.12,101.12,0,0,0,101.12,0ZM159,148.76H43.28a11.57,11.57,0,0,1-10-17.34L91.09,31.16a11.57,11.57,0,0,1,20.06,0L169,131.43a11.57,11.57,0,0,1-10,17.34Z"/><path class="cls-1" d="M101.12,36.93h0L43.27,137.21H159L101.13,36.94Zm0,88.7a7.71,7.71,0,1,1,7.71-7.71A7.71,7.71,0,0,1,101.12,125.63Zm7.71-50.13a7.56,7.56,0,0,1-.11,1.3l-3.8,22.49a3.86,3.86,0,0,1-7.61,0l-3.8-22.49a8,8,0,0,1-.11-1.3,7.71,7.71,0,1,1,15.43,0Z"/></g></g></svg>
            <h1>WEBSITE ĐANG BẢO TRÌ</h1>
            
            <div>
                <p>Xin lỗi vì sự bất tiện này, vui lòng quay lại trang web sau.</p>
               
            </div>
        </article>';
    }

    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./views/css/header.css">
    <link rel="stylesheet" href="./views/css/footer.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="./views/js/header.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- <style>
        .background_img{
            /* background-color: rgb(red, green, blue); */
            background-image: url(https://source.unsplash.com/E8Ufcyxz514/2400x1823);            
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
  
        }
    </style> -->
    <style>
        .img_logo {
            height: 60px;
            width: auto;
        }
    </style>

    <?php echo $caidat[0]['plugin_chat'] ?>

</head>

<body>
    <div class="background_img">


        <header>

            <div class="header">
                <div class="header__logo">
                    <ul class="header__list">
                        <li class="header__item header__item-logo"><img class="img_logo" src="<?php echo $caidat[0]['logo'] ?>" alt=""></li>
                    </ul>
                </div>

                <div class="header__menu">
                    <ul class="header__list">
                        <li class="header__item"><a href="./index.php?controller=trangchu">TRANG CHỦ</a></li>
                        <li class="header__item"><a href="./index.php?controller=lienhe">LIÊN HỆ</a></li>

                        <?php if (isset($_SESSION['taikhoan'])) : ?>

                            <?php if ($_SESSION['capbac'] != "admin") : ?>
                                <a href="./index.php?controller=nguoidung">
                                    <div class="header__item__taikhoan">

                                        <b class="showcustomer"></b>
                                        <div class="header__item__taikhoan__username">
                                            <?php echo $_SESSION['taikhoan']; ?>
                                        </div>

                                    </div>
                                </a>

                            <?php else : ?>


                                <a href="index.php?controller=admin">
                                    <li class="header__item header__item-dangki">Admin</li>
                                </a>


                            <?php endif; ?>
                            <a href="./index.php?controller=dangnhap&action=logout">
                                <div class="header__item__logout">
                                    <img src="./views/img/turn-off.png" alt="">


                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['taikhoan'])) : ?>

                            <a href="index.php?controller=dangnhap">
                                <li class="header__item header__item-dangki">ĐĂNG NHẬP</li>
                            </a>
                            <a href="./index.php?controller=dangki">
                                <li class="header__item header__item-dangki">ĐĂNG KÍ</li>
                            </a>



                        <?php endif; ?>
                        <div class="header__menu__button" onclick="toggle('.header__menu_hiden','flex')">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </ul>

                </div>
                <div class="header__menu_hiden">
                    <ul class="header__menu_hiden__list">
                        <li class="header__menu_hiden__item"><a href="./index.php?controller=trangchu">TRANG CHỦ</a></li>
                        <li class="header__menu_hiden__item"><a href="./index.php?controller=lienhe">LIÊN HỆ</a></li>

                        <?php if (!isset($_SESSION['taikhoan'])) : ?>

                            <a href="index.php?controller=dangnhap">
                                <li class="header__menu_hiden__item header__menu_hiden__item-dangnhap">ĐĂNG NHẬP</li>
                            </a>
                            <a href="./index.php?controller=dangki">
                                <li class="header__menu_hiden__item header__menu_hiden__item-dangki">ĐĂNG KÍ</li>
                            </a>
                        <?php else : ?>


                            <?php if ($_SESSION['capbac'] != "admin") : ?>

                                <a href="./index.php?controller=nguoidung">
                                    <li class="header__menu_hiden__item header__menu_hiden__item-dangnhap">

                                        <?php echo $_SESSION['taikhoan']; ?>

                                    </li>
                                </a>
                            <?php else : ?>
                                <a href="./index.php?controller=admin">
                                    <li class="header__menu_hiden__item header__menu_hiden__item-dangki">Admin</li>
                                </a>
                            <?php endif; ?>

                            <a href="./index.php?controller=dangnhap&action=logout">
                                <li class="header__menu_hiden__item header__menu_hiden__item-dangki">ĐĂNG XUẤT</li>
                            </a>

                        <?php endif; ?>

                    </ul>

                </div>



            </div>
        </header>