<?php include './views/header.php'; ?>
<?php if (!isset($_SESSION['taikhoan'])) {
    header("Location: .");
} ?>
<link rel="stylesheet" href="./views/nguoidung/css/nguoidung.css">
<div class="body">
    <div class="noidung">
        <div class="noidung__tieude">
            <h2><b>LỊCH SỬ MUA HÀNG</b></h2>
            <div class="noidung__tieude__line">
            </div>
        </div>
        <div class="taikhoan">

        <ul>
                <a href="./index.php?controller=nguoidung&action=thongtinnguoidung">
                    <li><b>Thông tin tài khoản</b></li>
                </a>
                <a href="./index.php?controller=nguoidung&action=lichsumuahang">
                    <li class="active"><b style="color: white;">Lịch sử mua hàng</b></li>
                </a>
                <a href="">
                    <li><b>Cài đặt</b></li>
                </a>
            </ul>
            <div class="taikhoan__thaotac">
                <div class="noidung__search">

                    <form class="form_search" action="" method="GET">

                        <input type="hidden" name="controller" value="nguoidung">
                        <input type="hidden" name="action" value="lichsumuahang">
                        <input type="hidden" name="iddanhmucgame" value="<?php echo $id_danhmucgame; ?>">

                        <div style="grid-area: aa;">
                            <span>MÃ SỐ</span>
                            <input class="noidung__search__input" placeholder="MÃ SỐ" name="maso" type="text">
                        </div>
                        <div style="grid-area: bb;">
                            <span>GIÁ TIỀN</span>
                            <select name="giatien" id="" class="">
                                <option style="display: none;" value="khongchon" selected disabled>Không chọn</option>
                                <option value="<50000">Dưới 50K</option>
                                <option value="<200000">Dưới 200K</option>
                                <option value="<500000">Dưới 500K</option>
                                <option value="<1000000">Dưới 1M</option>
                                <option value=">1000000">Trên 1M</option>
                            </select>
                        </div>
                        <div style="grid-area: cc;">
                            <span>TỪ NGÀY</span>
                            <input class="noidung__search__input" name="tungay" type="date">
                        </div>
                        <div style="grid-area: dd;">
                            <span>ĐẾN NGÀY</span>
                            <input class="noidung__search__input" name="denngay" type="date">
                        </div>

                        <div style="grid-area: ee;">
                            <input class="noidung__search__submit" type="submit" value="Tìm kiếm">
                            <a href="./index.php?controller=nguoidung&action=lichsumuahang" id="noidung__search__submit_all">Tất cả</a>
                        </div>

                    </form>

                </div>



                <!-- lichsumuahang -->
                <div class="div_table">
                    <table class="table table-striped" style="font-size: 14px;">
                        <tr>
                            <th style="background-color: black;color: white;">
                                ID
                            </th>
                            <th style="background-color: black;color: white;">
                                ID TÀI KHOẢN GAME
                            </th>
                            <th style="background-color: black;color: white;">
                                GAME
                            </th>
                            <th style="background-color: black;color: white;">
                                GIÁ TIỀN
                            </th>
                            <th style="background-color: black;color: white;">
                                THỜI GIAN
                            </th>
                            <th style="background-color: black;color: white;">
                                THAO TÁC
                            </th>
                        </tr>

                        <?php foreach ($lichsudonhang as $lichsudonhangs) : ?>

                            <tr>
                                <th>
                                    #DH<?php echo $lichsudonhangs['id_donhang'] ?>
                                </th>
                                <th>
                                    #<?php echo $lichsudonhangs['id_taikhoangame'] ?>
                                </th>
                                <th>
                                    <?php echo $lichsudonhangs['tengame'] ?>
                                </th>
                                <th>

                                    <?php $sodu = (int)$lichsudonhangs['giatien'];
                                    $sodu = number_format($sodu, 0, '.', ',');
                                    echo $sodu; ?>
                                    <span style="color: red;"><b>&nbsp;VNĐ</b></span>
                                </th>
                                <th>
                                    <?php echo $lichsudonhangs['thoigianmua'] ?>
                                </th>
                                <th>
                                    <button type="button" style="color: azure;font-size: 10px;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $lichsudonhangs['id_taikhoangame'] ?>">XEM THÊM</button>

                                </th>

                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo $lichsudonhangs['id_taikhoangame'] ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Thông tin nick</h4>
                                        </div>
                                        <div class="modal-body">
                                            <label for="myInput">TÀI KHOẢN</label>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Tên tài khoản</span>
                                                <input type="text" class="form-control" id="input_taikhoangame<?php echo $lichsudonhangs['id_taikhoangame'] ?>" value="<?php echo $lichsudonhangs['username'] ?>" aria-label="Username" aria-describedby="basic-addon1" disabled>
                                                <button type="button" class="btn btn-danger" onclick="copy('input_taikhoangame<?php echo $lichsudonhangs['id_taikhoangame'] ?>')">Sao chép</button>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Mật khẩu</span>
                                                <input type="text" class="form-control" id="input_matkhaugame<?php echo $lichsudonhangs['id_taikhoangame'] ?>" value="<?php echo $lichsudonhangs['password'] ?>" aria-label="Username" aria-describedby="basic-addon1" disabled>
                                                <button type="button" class="btn btn-danger" onclick="copy('input_matkhaugame<?php echo $lichsudonhangs['id_taikhoangame'] ?>')">Sao chép</button>
                                            </div>

                                            <script>
                                                function copy(a) {
                                                    var copyText = document.getElementById(a);
                                                    copyText.select();
                                                    copyText.setSelectionRange(0, 99999);
                                                    navigator.clipboard.writeText(copyText.value);
                                                    alert("Đã sao chép ");
                                                }
                                            </script>
                                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                            Lưu ý #1
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                                        <div class="accordion-body">
                                                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                                            Hướng dẫn đăng nhập #2
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                                        <div class="accordion-body">
                                                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                                            Tha #3
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                                        <div class="accordion-body">
                                                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    </table>
                </div>
                <div style="width: 100%;display: flex;justify-content: center;">

                    <?php

                    $page =  (int)($_GET['page'] ?? "1");
                    $count = 1;
                    $count_2 = 1;

                    $maso = $_REQUEST['maso'] ?? null;
                    $giatien = $_REQUEST['giatien'] ?? null;
                    $tungay = $_REQUEST['tungay'] ?? null;
                    $denngay = $_REQUEST['denngay'] ?? null;
                    if ($maso != null) {
                        $maso = "&maso=" . $maso;
                    }
                    if ($giatien != null) {
                        $giatien = "&giatien=" . $giatien;
                    }
                    if ($tungay != null) {
                        $tungay = "&tungay=" . $tungay;
                    }
                    if ($denngay != null) {
                        $denngay = "&denngay=" . $denngay;
                    }


                    ?>
                    <div class="pagination">
                        <a class="" href="<?php if ($page > 1) echo "./index.php?controller=nguoidung&action=lichsumuahang$maso$giatien$tungay$denngay&page=" . $page - 1 ?>">&laquo;</a>
                        <a class="<?php if ($page == 1) echo "active" ?>" href="<?php echo "./index.php?controller=nguoidung&action=lichsumuahang$maso$giatien$tungay$denngay&page=1" ?>">1</a>
                        <?php if ($maxpage > 6) : ?>
                            <?php if ($page >= 1 && $page < 5) : ?>

                                <?php for ($i = 2; $i < $page + 6; $i++) : ?>
                                    <?php if ($count_2 == 5) : ?>
                                        <a class="">. . .</a>
                                    <?php else : ?>
                                        <a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=nguoidung&action=lichsumuahang$maso$giatien$tungay$denngay&page=$i" ?>"><?php echo $i ?></a>
                                    <?php endif; ?>
                                    <?php $count = $count + 1;
                                    $count_2 = $count_2 + 1;
                                    if ($count == 6) {
                                        break;
                                    };
                                    ?>
                                <?php endfor; ?>

                            <?php elseif ($page >= 5 && $page <= $maxpage - 4) : ?>
                                <?php for ($i = $page - 2; $i < $page + 3; $i++) : ?>
                                    <?php if ($count_2 == 1 || $count_2 == 5) : ?>
                                        <a class="">. . .</a>
                                    <?php else : ?>
                                        <a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=nguoidung&action=lichsumuahang$maso$giatien$tungay$denngay&page=$i" ?>"><?php echo $i ?></a>
                                    <?php endif; ?>
                                    <?php $count = $count + 1;
                                    $count_2 = $count_2 + 1;
                                    if ($count == 6) {
                                        break;
                                    };
                                    ?>
                                <?php endfor; ?>
                            <?php else : ?>
                                <?php for ($i = $maxpage - 5; $i < $maxpage; $i++) : ?>
                                    <?php if ($count_2 == 1) : ?>
                                        <a class="">. . .</a>
                                    <?php else : ?>
                                        <a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=nguoidung&action=lichsumuahang$maso$giatien$tungay$denngay&page=$i" ?>"><?php echo $i ?></a>
                                    <?php endif; ?>
                                    <?php $count = $count + 1;
                                    $count_2 = $count_2 + 1;
                                    if ($count == 6) {
                                        break;
                                    };
                                    ?>
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php else : ?>

                            <?php for ($i = 2; $i < $maxpage; $i++) : ?>

                                <a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=nguoidung&action=lichsumuahang$maso$giatien$tungay$denngay&page=$i" ?>"><?php echo $i ?></a>

                            <?php endfor; ?>
                        <?php endif; ?>
                        <?php if ($maxpage != 0 && $maxpage != 1) : ?>
                            <a class="<?php if ($maxpage == $page) echo "active" ?>" href="<?php echo "./index.php?controller=nguoidung&action=lichsumuahang$maso$giatien$tungay$denngay&page=$maxpage" ?>"><?php echo $maxpage ?></a>
                        <?php endif; ?>
                        <a class="" href="<?php if ($page < $maxpage) echo "./index.php?controller=nguoidung&action=lichsumuahang$maso$giatien$tungay$denngay&page=" . $page + 1. ?>">&raquo;</a>
                    </div>



                </div>






            </div>




        </div>



    </div>

</div>
</div>
<?php include './views/footer.php'; ?>