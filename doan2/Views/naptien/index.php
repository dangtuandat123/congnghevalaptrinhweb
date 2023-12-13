<?php include './views/header.php'; ?>
<link rel="stylesheet" href="./views/naptien/css/index.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<div class="body">
    <div class="noidung">
        <div class="noidung__dieuhuong">
            <!-- <a href=".">TRANG CHỦ</a>&nbsp;/&nbsp;<a href="./index.php?controller=danhmucgame">MUA NICK</a>
            &nbsp;/&nbsp;<a href="./index.php?controller=taikhoangame&idtaikhoangame=<?php echo $taikhoangame['id_taikhoangame'] ?>
            &iddanhmucgame=<?php echo $taikhoangame['id_danhmucgame'] ?>">TÀI KHOẢN GAME #<?php echo $taikhoangame['id_taikhoangame'] ?></a> -->
        </div>
        <h3>LỰA CHỌN PHƯƠNG THỨC NẠP TIỀN</h3>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($phuongthucthanhtoan as $phuongthucthanhtoans) : ?>
                <div class="col">
                    <div class="card">
                        <img src="<?php echo $phuongthucthanhtoans['img'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $phuongthucthanhtoans['tennganhang'] ?></h5>
                            <p class="card-text">Nạp tự động qua ngân hàng siêu nhanh.</p>
                            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal<?php echo $phuongthucthanhtoans['id_nganhang'] ?>">NẠP NGAY</button>
                        </div>
                    </div>
                </div>



                <!-- Modal -->
                <div class="modal fade" id="myModal<?php echo $phuongthucthanhtoans['id_nganhang'] ?>" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Vui lòng nhập số tiền cần nạp</h4>
                            </div>
                            <div class="modal-body" style="text-align: center;">
                                <form action="./index.php?controller=naptien&action=naptien" method="post">

                                    <input type="hidden" value="<?php echo $phuongthucthanhtoans['id_nganhang'] ?>" name="id_nganhang">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">SỐ TIỀN</span>
                                        <input type="text" class="form-control" placeholder="Vui lòng nhập số tiền muốn nạp" name="sotiennap" required>
                                    </div>
                                    <button style="font-size: 17px;" type="submit" class="btn btn-success">Đồng ý</button>

                                </form>


                            </div>
                            <div class="modal-footer">
                                <button style="font-size: 17px;" type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                            </div>
                        </div>



                    </div>


                </div>

                <?php if (isset($_GET['thongbaonaptien'])) : ?>
                    <?php if ($_GET['thongbaonaptien'] == "napthanhcong") : ?>
                        <?php echo " <script>
                            alert('Đã nạp thành công')
                            window.location.href = './index.php?controller=naptien';
                        </script>" ?>



                    <?php else : ?>

                        <?php echo " <script>
                            alert('Nạp tiền không thành công')
                            window.location.href = './index.php?controller=naptien';
                        </script>" ?>

                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; ?>

        </div>





    </div>


</div>

<?php include './views/footer.php'; ?>