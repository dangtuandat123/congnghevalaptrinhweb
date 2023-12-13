<?php include './views/header.php'; ?>
<link rel="stylesheet" href="./views/taikhoangame/css/index.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<div class="body">
    <div class="noidung">
        <div class="noidung__dieuhuong">
            <a href=".">TRANG CHỦ</a>&nbsp;/&nbsp;<a href="./index.php?controller=danhmucgame">MUA NICK</a>
            &nbsp;/&nbsp;<a href="./index.php?controller=taikhoangame&idtaikhoangame=<?php echo $taikhoangame['id_taikhoangame'] ?>
            &iddanhmucgame=<?php echo $taikhoangame['id_danhmucgame'] ?>">TÀI KHOẢN GAME #<?php echo $taikhoangame['id_taikhoangame'] ?></a>
        </div>

        <div class="noidung__thongtinacc">
            <div class="thongtinacc__info">
                <div class="thongtinacc__tenGame">
                    <b><?php echo $tengame; ?></b>
                    <div class="noidung__tieude__line"></div>

                </div>

                <div class="thongtinacc__mota">

                    <div class="thongtinacc__mota__maso">
                        mã tài khoản #<?php echo $taikhoangame['id_taikhoangame'] ?>
                    </div>
                    <div class="thongtinacc__mota__dangki">
                        <?php echo $taikhoangame['loaidangki'] ?>
                    </div>

                </div>

                <div class="thongtinacc__giatien">
                    <div class="thongtinacc__giatien_1">
                        <b>
                            <span style="color: #666;text-decoration: line-through;">
                                <?php
                                $giatien =  $taikhoangame['giatien'];
                                $giatien = number_format($giatien, 0, '.', ',');
                                echo $giatien;
                                ?>đ

                            </span>
                            &nbsp;
                            <?php $giamgia =  (int)$taikhoangame['giamgia'];
                            $giatien = (int)$taikhoangame['giatien'];
                            $giaTienSauGiamGia = $giatien - (($giatien * $giamgia) / 100);
                            $giaTienSauGiamGia = (string)$giaTienSauGiamGia;
                            $giaTienSauGiamGia = number_format($giaTienSauGiamGia, 0, '.', ',');
                            echo $giaTienSauGiamGia; ?>đ
                        </b>

                    </div>

                    <div class="thongtinacc__giatien_2">
                        <b>đặt cọc</b>
                    </div>



                    <!-- Trigger the modal with a button -->
                    <button type="button" class="thongtinacc__giatien_3" data-toggle="modal" data-target="#muahang"><b>MUA NGAY</b></button>

                    <!-- Modal -->
                    <div class="modal fade" style="width: 100%; top: calc(40vh - 100px)" id="muahang" role="dialog">
                        <div class="modal-dialog modal-lg" style="border-radius: 20px;">

                            <?php if (isset($_SESSION['taikhoan'])) : ?>
                                <div class="modal-content" style="border-radius: 20px;">
                                    <div class="modal-body">
                                        <div class="model_title" style="border-radius: 15px;">
                                            <h2><b>Xác nhận mua tài khoản #<?php echo $taikhoangame['id_taikhoangame'] ?></b></h2>
                                            <div class="thongtinacc__giatien_1">
                                                <b style="background-color: white;padding: 10px; margin: 20px 0px -40px 0px; border-radius: 10px;">
                                                    <span style="color: #000000;">
                                                        THANH TOÁN

                                                    </span>
                                                    <?php $giamgia =  (int)$taikhoangame['giamgia'];
                                                    $giatien = (int)$taikhoangame['giatien'];
                                                    $giaTienSauGiamGia = $giatien - (($giatien * $giamgia) / 100);
                                                    $sotienthanhtoan =  $giaTienSauGiamGia;
                                                    $giaTienSauGiamGia = (string)$giaTienSauGiamGia;
                                                    $giaTienSauGiamGia = number_format($giaTienSauGiamGia, 0, '.', ',');
                                                    echo $giaTienSauGiamGia; ?>&nbsp;VNĐ
                                                </b>

                                            </div>

                                            <div class="model_thanhtoan">

                                                <div class="model_thanhtoan_aa">
                                                    phương thức thanh toán
                                                </div>
                                                <div class="model_thanhtoan_bb">
                                                    <div class="model_img_2">
                                                        <a href="./index.php?controller=thanhtoan&sotien=<?php echo $sotienthanhtoan; ?>&phuongthucthanhtoan=vnpay&idtaikhoangame=<?php echo $taikhoangame['id_taikhoangame'] ?>&iddanhmucgame=<?php echo $taikhoangame['id_danhmucgame'] ?>">
                                                            <img src="https://play-lh.googleusercontent.com/o-_z132f10zwrco4NXk4sFqmGylqXBjfcwR8-wK0lO1Wk4gzRXi4IZJdhwVlEAtpyQ" alt="" onclick="vnpay()">
                                                        </a>
                                                        <!-- <script>
                                                            function vnpay() {
                                                                var xhr = new XMLHttpRequest();
                                                                xhr.open('POST', './index.php', true);
                                                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                                                xhr.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        console.error('Phản hồi từ máy chủ:', this.responseText);
                                                                        var response = this.responseText.replace(/<[^>]*>/g, '').trim()
                                                                        if (response == 'thanhcong') {
                                                                            window.location.href = './index.php?controller=naptien&thongbaonaptien=napthanhcong&sotien=1200';
                                                                        } else if (response == 'khongthanhcong') {
                                                                            window.location.href = './index.php?controller=naptien';
                                                                        }
                                                                    }
                                                                };
                                                                var data = 'controller=thanhtoan&sotien=<?php echo $sotienthanhtoan; ?>&phuongthucthanhtoan';
                                                                xhr.send(data);


                                                            }
                                                        </script> -->

                                                    </div>

                                                </div>

                                                <div class="model_thanhtoan_cc">
                                                    <div class="model_img">
                                                        <a href="./index.php?controller=thanhtoan&sotien=<?php echo $sotienthanhtoan; ?>&phuongthucthanhtoan=momo&idtaikhoangame=<?php echo $taikhoangame['id_taikhoangame'] ?>&iddanhmucgame=<?php echo $taikhoangame['id_danhmucgame'] ?>">
                                                            <img src="https://play-lh.googleusercontent.com/dQbjuW6Jrwzavx7UCwvGzA_sleZe3-Km1KISpMLGVf1Be5N6hN6-tdKxE5RDQvOiGRg" alt="">

                                                        </a>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" style="font-size: 15px; border-radius: 10px;" data-dismiss="modal">Đóng</button>

                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="modal-content" style="border-radius: 20px;">
                                    <div class="modal-body">
                                        <div class="model_title" style="border-radius: 15px;">
                                            <h2><b>Vui lòng đăng nhập để mua hàng!</b></h2>
                                            <a href="./index.php?controller=dangnhap" class="btn btn-info" style="font-size: 15px; border-radius: 10px; color: white;"><b>ĐĂNG NHẬP NGAY</b></a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" style="font-size: 15px; border-radius: 10px;" data-dismiss="modal">Đóng</button>

                                    </div>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>





                </div>




            </div>
            <div class="thongtinacc__hinhAnh_tieude">
                <div class="noidung__tieude__line_2"></div>
                <div class="noidung__tieude__line_2_text">
                    MÔ TẢ VỀ SẢN PHẨM
                </div>
            </div>
            <div class="noidung__thongtinacc__motasanpham">
                <p><?php echo $taikhoangame['motachitiet'] ?></p>
            </div>
            <div class="thongtinacc__hinhAnh_tieude">
                <div class="noidung__tieude__line_2"></div>
                <div class="noidung__tieude__line_2_text">
                    HÌNH ẢNH VỀ SẢN PHẨM
                </div>
            </div>
            <div class="thongtinacc__hinhAnh">
                <?php
                $hinhanhgame = explode(",", $taikhoangame['hinhanhchitiet']);
                foreach ($hinhanhgame as $hinhanhgames) : ?>
                    <img src="<?php echo $hinhanhgames; ?>" alt="">
                <?php endforeach; ?>
            </div>


        </div>


        <div class="noidung_dichvu">



        </div>


    </div>


</div>

<?php include './views/footer.php'; ?>