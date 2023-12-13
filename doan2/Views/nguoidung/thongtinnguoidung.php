<?php include './views/header.php'; ?>
<?php if (!isset($_SESSION['taikhoan'])) {
    header("Location: .");
} ?>
<link rel="stylesheet" href="./views/nguoidung/css/nguoidung.css">
<div class="body">
    <div class="noidung">
        <div class="noidung__tieude">
            <h2><b>THÔNG TIN NGƯỜI DÙNG</b></h2>
            <div class="noidung__tieude__line">
            </div>
        </div>
        <div class="taikhoan">

            <ul>
                <a href="./index.php?controller=nguoidung&action=thongtinnguoidung">
                    <li class="active"><b style="color: white;">Thông tin tài khoản</b></li>
                </a>
                <a href="./index.php?controller=nguoidung&action=lichsumuahang">
                    <li><b>Lịch sử mua hàng</b></li>
                </a>
                <a href="">
                    <li><b>Cài đặt</b></li>
                </a>
            </ul>
            <div class="taikhoan__thaotac">



                <!-- thongtintaikhoan -->
                <div class="thongtintaikhoan">
                    <div class="thongtintaikhoan_avartar">
                        <img src="./views/img/avt.webp" alt="">
                        <h2><?php echo $nguoidung['taikhoan'] ?></h2>
                        <div class="thongtintaikhoan__card">
                           
                           
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Tên tài khoản</span>
                        <input type="text" class="form-control" placeholder="<?php echo $nguoidung['taikhoan'] ?>" aria-label="Username" aria-describedby="basic-addon1" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">ID người dùng</span>
                        <input type="text" class="form-control" placeholder="<?php echo $nguoidung['id_nguoidung'] ?>" aria-label="Username" aria-describedby="basic-addon1" disabled>
                    </div>
                    <form action="." method="get">
                        <input type="hidden" name="controller" value="nguoidung">
                        <input type="hidden" name="action" value="capnhapthongtinnguoidung">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Số điện thoại</span>
                            <input type="text" class="form-control" placeholder="Cập nhập số điện thoại" name="sodienthoai" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $nguoidung['sodienthoai'] ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                            <input type="text" class="form-control" placeholder="Cập nhập Email" name="email" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $nguoidung['email'] ?>">
                        </div>


                        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">CẬP NHẬP</button>


                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Bạn có muốn cập nhập thông tin?</h4>
                                    </div>
                                    <div class="modal-body" style="text-align: center;">

                                        <button style="font-size: 17px;" type="submit" class="btn btn-success">Đồng ý</button>
                                        <button style="font-size: 17px;" type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>

                            </div>
                        </div>


                    </form>
                    <form action="./index.php?controller=nguoidung&action=doimatkhau" method="post">
                        <h2 style="margin: 10px 0px;">ĐỔI MẬT KHẨU</h2>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Mật khẩu hiện tại</span>
                            <input type="password" class="form-control" placeholder="Vui lòng nhập mật khẩu hiện tại" name="matkhaucu" id="matkhaucu" onchange="kiemtralaimatkhau()" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Mật khẩu mới</span>
                            <input type="password" class="form-control" placeholder="Vui lòng nhập mật khẩu mới" name="matkhaumoi" id="matkhaumoi" onchange="kiemtralaimatkhau()" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Nhập lại mật khẩu mới</span>
                            <input type="password" class="form-control" placeholder="Vui lòng nhập lại mật khẩu mới" name="nhaplaimatkhaumoi" id="nhaplaimatkhaumoi" onchange="kiemtralaimatkhau()" required>
                        </div>
                        <p id="xacnhanmatkhau"></p>
                        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#doimatkhau" id="nutdoimatkhau">ĐỔI MẬT KHẨU</button>

                        <script>
                            document.getElementById("matkhaucu").addEventListener("input", function() {
                                kiemtralaimatkhau() ;

                            });
                            document.getElementById("matkhaumoi").addEventListener("input", function() {
                                
                                kiemtralaimatkhau() ;
                            });
                            document.getElementById("nhaplaimatkhaumoi").addEventListener("input", function() {
                                
                                kiemtralaimatkhau() ;
                            });
                            function kiemtralaimatkhau() {
                                var matkhaucu = document.getElementById("matkhaucu").value;
                                var matkhaumoi = document.getElementById("matkhaumoi").value;
                                var nhaplaimatkhaumoi = document.getElementById("nhaplaimatkhaumoi").value;
                                if (matkhaucu != "" && matkhaumoi != "" && nhaplaimatkhaumoi != "") {
                                    if (matkhaumoi === nhaplaimatkhaumoi) {

                                        document.getElementById("xacnhanmatkhau").innerHTML = "<span style='color: green;'>Nhập lại mật khẩu đúng!</span>";
                                        document.getElementById("nutdoimatkhau").setAttribute("data-target", "#doimatkhau");

                                    } else {
                                        document.getElementById("xacnhanmatkhau").innerHTML = "<span style='color: red;'>Nhập lại mật khẩu sai!</span>";
                                        document.getElementById("nutdoimatkhau").setAttribute("data-target", "#34343");
                                    }
                                } else {
                                    document.getElementById("xacnhanmatkhau").innerHTML = "<span style='color: red;'>Vui lòng điền đầy đủ thông tin!</span>";
                                    document.getElementById("nutdoimatkhau").setAttribute("data-target", "#34343");
                                }
                            }
                        </script>



                        <!-- Modal -->
                        <div class="modal fade" id="doimatkhau" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Bạn có muốn cập nhập mật khẩu?</h4>
                                    </div>
                                    <div class="modal-body" style="text-align: center;">

                                        <button style="font-size: 17px;" type="submit" class="btn btn-success">Đồng ý</button>
                                        <button style="font-size: 17px;" type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <h4 style="color: <?php if(isset($color))echo $color; ?>;margin: 10px 0px;"><?php if(isset($thongbao)) echo $thongbao;?></h4>




                </div>





            </div>

        </div>

    </div>

</div>
</div>
<?php include './views/footer.php'; ?>