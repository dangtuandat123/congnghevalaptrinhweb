<?php include './views/header.php'; ?>
<link rel="stylesheet" href="./views/danhmucgame/css/show.css">
<div class="body">
    <div class="noidung">
        <div class="noidung__dieuhuong">
            <a href=".">TRANG CHỦ</a>&nbsp;/&nbsp;<a href="./index.php?controller=danhmucgame">MUA NICK</a>
            &nbsp;/&nbsp;<a href="./index.php?controller=danhmucgame&action=show&iddanhmucgame=<?php echo $id_danhmucgame; ?>"><?php if (isset($tengame)) echo $tengame ?></a>
        </div>

        <div class="noidung__thumbnal" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),  url(<?php if (isset($thumbnal)) echo $thumbnal ?>);">
            <div><?php if (isset($tengame)) echo $tengame ?></div>
        </div>

        <div class="noidung__search">
            
            <form class="form_search" action="" method="GET">

                <input type="hidden" name="controller" value="danhmucgame">
                <input type="hidden" name="action" value="loctaikhoan">
                <input type="hidden" name="iddanhmucgame" value="<?php echo $id_danhmucgame; ?>">

                <div style="grid-area: aa;">
                    <span>MÃ SỐ</span>
                    <input class="noidung__search__input" placeholder="MÃ SỐ" name="maso" type="text">
                </div>
                <div style="grid-area: bb;">
                    <span>GIÁ TIỀN</span>
                    <select name="giatien" id="" class="">
                        <option style="display: none;" value="khongchon" selected disabled>Không chọn</option>
                        <option value="< 50000">Dưới 50K</option>
                        <option value="< 200000">Dưới 200K</option>
                        <option value="< 500000">Dưới 500K</option>
                        <option value="< 1000000">Dưới 1M</option>
                        <option value="> 1000000">Trên 1M</option>

                    </select>
                </div>
                <div style="grid-area: cc;">
                    <span>ĐĂNG KÍ</span>
                    <select name="loaidangki" id="" class="">
                        <option style="display: none;" value="khongchon" selected disabled>Không chọn</option>
                        <option value="Đăng kí ảo">Đăng kí ảo</option>
                        <option value="Đăng kí thật">Đăng kí thật</option>


                    </select>
                </div>
                <div style="grid-area: dd;">
                    <span>SẮP XẾP THEO</span>
                    <select name="sapxeptheo" id="" class="">
                        <option style="display: none;" value="khongchon" selected disabled>Không chọn</option>
                        <option value="giatuthapdencao">Giá từ thấp đến cao</option>
                        <option value="giatucaodenthap">Giá từ cao đến thấp</option>
                        <option value="giamgia">Giảm giá nhiều</option>
                    </select>
                </div>

                <div style="grid-area: ee;">
                    <input class="noidung__search__submit" type="submit" value="Tìm kiếm">
                    <a href="./index.php?controller=danhmucgame&action=show&iddanhmucgame=<?php echo $id_danhmucgame; ?>" id="noidung__search__submit_all">Tất cả</a>
                </div>

            </form>

        </div>

        <div class="noidung_dichvu">
            <?php foreach ($taikhoangame as $taikhoangames) : ?>

                <div class="noidung_dichvu_item">
                    <?php if ($taikhoangames['giamgia'] !== "0") : ?>
                        <div class="bang_giamgia"><b>Giảm <?php echo $taikhoangames['giamgia'] ?>%</b></div>
                    <?php endif; ?>

                    <a href="./index.php?controller=taikhoangame&idtaikhoangame=<?php echo $taikhoangames['id_taikhoangame'] ?>&iddanhmucgame=<?php echo $id_danhmucgame; ?>"><img src="<?php echo $taikhoangames['img'] ?>" alt=""></a>
                    <div class="noidung_dichvu_item__text">

                        <div class="noidung_dichvu_item__text_1">
                            <div><?php echo $taikhoangames['mota'] ?></div>

                        </div>
                        <div class="noidung_dichvu_item__text_2">
                            <div class="mo_ta_acc">
                                <div>MÃ:</div>
                                <div><b>#<?php echo $taikhoangames['id_taikhoangame'] ?></b></div>
                                <div>LOẠI:</div>
                                <div><b><?php echo $taikhoangames['loaidangki'] ?></b></div>


                            </div>
                            <div>
                                <?php if ($taikhoangames['giamgia'] !== "0") : ?>
                                    <span style="color: #666;text-decoration: line-through;">
                                        <?php
                                        $giatien =  $taikhoangames['giatien'];
                                        $giatien = number_format($giatien, 0, '.', ',');
                                        echo $giatien;
                                        ?>đ
                                    </span>
                                    &nbsp;
                                <?php endif; ?>
                                <?php
                                $giamgia =  (int)$taikhoangames['giamgia'];
                                $giatien = (int)$taikhoangames['giatien'];
                                $giaTienSauGiamGia = $giatien - (($giatien * $giamgia) / 100);
                                $giaTienSauGiamGia = (string)$giaTienSauGiamGia;
                                $giaTienSauGiamGia = number_format($giaTienSauGiamGia, 0, '.', ',');
                                echo $giaTienSauGiamGia;
                                ?>đ
                            </div>


                        </div>
                        <div class="noidung_dichvu_item__text_3">
                            <a href="./index.php?controller=taikhoangame&idtaikhoangame=<?php echo $taikhoangames['id_taikhoangame'] ?>&iddanhmucgame=<?php echo $id_danhmucgame; ?>">
                                <div>CHI TIẾT</div>
                            </a>
                        </div>


                    </div>


                </div>
            <?php endforeach; ?>



        </div>
        <div style="width: 100%;display: flex;justify-content: center;">


            <?php 
            
            $page =  (int)($_GET['page'] ?? "1");
            $count = 1;
            $count_2 = 1;
            $action = $_REQUEST['action'] ?? null;
            $maso = $_REQUEST['maso'] ?? null;
            $giatien = $_REQUEST['giatien'] ?? null;
            $loaidangki = $_REQUEST['loaidangki'] ?? null;
            $sapxeptheo = $_REQUEST['sapxeptheo'] ?? null;
            if($action!=null){
                $action= "&action=".$action;
            }if($maso!=null){
                $maso= "&maso=".$maso;
            }if($giatien!=null){
                $giatien= "&giatien=".$giatien;
            }if($loaidangki!=null){
                $loaidangki= "&loaidangki=".$loaidangki;
            }if($sapxeptheo!=null){
                $sapxeptheo= "&sapxeptheo=".$sapxeptheo;
            }
            ?>


            <div class="pagination">
                <a class="" href="<?php if ($page > 1) echo "./index.php?controller=danhmucgame$action&iddanhmucgame=$id_danhmucgame$maso$giatien$loaidangki$sapxeptheo&page=" . $page - 1 ?>">&laquo;</a>
                <a class="<?php if ($page == 1) echo "active" ?>" href="<?php echo "./index.php?controller=danhmucgame$action&iddanhmucgame=$id_danhmucgame$maso$giatien$loaidangki$sapxeptheo&page=1" ?>">1</a>
                <?php if ($maxpage > 6) : ?>
                    <?php if ($page >= 1 && $page < 5) : ?>

                        <?php for ($i = 2; $i < $page + 6; $i++) : ?>
                            <?php if ($count_2 == 5) : ?>
                                <a class="">. . .</a>
                            <?php else : ?>
                                <a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=danhmucgame$action&iddanhmucgame=$id_danhmucgame$maso$giatien$loaidangki$sapxeptheo&page=$i" ?>"><?php echo $i ?></a>
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
                                <a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=danhmucgame$action&iddanhmucgame=$id_danhmucgame$maso$giatien$loaidangki$sapxeptheo&page=$i" ?>"><?php echo $i ?></a>
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
                                <a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=danhmucgame$action&iddanhmucgame=$id_danhmucgame$maso$giatien$loaidangki$sapxeptheo&page=$i"?>"><?php echo $i ?></a>
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

                        <a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=danhmucgame$action&iddanhmucgame=$id_danhmucgame$maso$giatien$loaidangki$sapxeptheo&page=$i" ?>"><?php echo $i ?></a>

                    <?php endfor; ?>
                <?php endif; ?>
                <?php if ($maxpage != 0 && $maxpage !=1) : ?>
                    <a class="<?php if ($maxpage == $page) echo "active" ?>" href="<?php echo "./index.php?controller=danhmucgame$action&iddanhmucgame=$id_danhmucgame$maso$giatien$loaidangki$sapxeptheo&page=$maxpage" ?>"><?php echo $maxpage ?></a>
                <?php endif; ?>
                <a class="" href="<?php if ($page < $maxpage) echo "./index.php?controller=danhmucgame$action&iddanhmucgame=$id_danhmucgame$maso$giatien$loaidangki$sapxeptheo&page=" . $page + 1. ?>">&raquo;</a>
            </div>
        </div>
    </div>




</div>
<?php include './views/footer.php'; ?>