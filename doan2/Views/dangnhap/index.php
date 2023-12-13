<?php include './views/header.php'; ?>
<?php if (isset($_SESSION['taikhoan'])) {
    header("Location: .");
} ?>
<link rel="stylesheet" href="./views/dangnhap/css/dangnhap.css">
<div class="body">
    <div class="noidung">

        <div class="login">
            <h1>ĐĂNG NHẬP</h1>
            <h5 style="color: <?php if(isset($color)){echo $color;}else{echo "red";}?>;"><?php if(isset($thongbao)){ echo $thongbao;}else{echo "&nbsp;";}; ?></h5>
            <form action="" method="GET">
                <input type="hidden" name="controller" value="dangnhap">
                <input type="hidden" name="action" value="login">
                <input class="input1" type="text" placeholder="Tên đăng nhập" name="username" required>
                <input class="input1" type="password" placeholder="Mật khẩu" name="password" required>
                <!-- <input type="checkbox"><label>&nbsp;Nhớ mật khẩu</label> -->
                <a class="a1" href="#">Quên mật khẩu?</a>
                <button type="submit">Đăng nhập</button>
            </form>
            <p>Bạn chưa có tài khoản? <a class="a2" href="./index.php?controller=dangki">Đăng ký ngay</a></p>
        </div>

    </div>


</div>

</div>
<?php include './views/footer.php'; ?>