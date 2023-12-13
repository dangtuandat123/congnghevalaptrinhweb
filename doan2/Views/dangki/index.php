<?php include './views/header.php'; ?>
<?php if (isset($_SESSION['taikhoan'])) {
    header("Location: .");
} ?>
<link rel="stylesheet" href="./views/dangki/css/dangki.css">
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>

<div class="body">
    <div class="noidung">

        <div class="login">
            <h1>ĐĂNG KÍ</h1>
            <h5 style="color: <?php echo $color?>;"><?php if(isset($thongbao)){ echo $thongbao;}else{echo "&nbsp;";}; ?></h5>
            <form action="" method="GET">
                <input type="hidden" name="controller" value="dangki">
                <input type="hidden" name="action" value="dangki">
                <input class="input1" type="text" placeholder="Tên đăng nhập" name="username" required>
                <input class="input1" type="password" placeholder="Mật khẩu" name="password" required>
                <input class="input1" type="password" placeholder="Nhập lại mật khẩu" name="repassword" required>
                <div class="g-recaptcha" data-sitekey="6LfhEC8pAAAAANiap597BhT1N5hl9Xd7iD2aZKnR"></div>
                <button type="submit">Đăng kí</button>
            </form>
            
        </div>

    </div>

</div>

</div>
<?php include './views/footer.php'; ?>