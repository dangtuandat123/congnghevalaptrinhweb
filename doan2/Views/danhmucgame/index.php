<?php include './views/header.php'; ?>
<link rel="stylesheet" href="./views/danhmucgame/css/index.css">
<div class="body">
    <div class="noidung">
        <div class="noidung__dieuhuong">
            <a href=".">TRANG CHỦ</a>&nbsp;/&nbsp;<a href="./index.php?controller=danhmucgame">MUA NICK</a>
        </div>

        <div class="noidung__search">
            <form class="form_1" action="" method="GET">
                <input type="hidden" name="controller" value="danhmucgame">
                <input type="hidden" name="action" value="timkiem">
                <input class="noidung__search__input" placeholder="Tìm game" name="tukhoa" type="text">
                <input class="noidung__search__submit" type="submit" value="Tìm kiếm"> 
            </form>

            <form action="" method="GET">
                <input type="hidden" name="controller" value="danhmucgame">
                <input type="hidden" name="action" value="timkiem">
                <input  name="tukhoa" value="" type="hidden">
                <input class="" id="noidung__search__submit_all" type="submit" value="Tất cả">
                
            </form>
        </div>

        <div class="noidung_dichvu">
            <?php foreach ($danhmucgame as $danhmucgames) : ?>

                <div class="noidung_dichvu_item">

                    <a href="./index.php?controller=danhmucgame&action=show&iddanhmucgame=<?php echo $danhmucgames['id_danhmucgame'] ?>"><img src="<?php echo $danhmucgames['img'] ?>" alt=""></a>
                    <div class="noidung_dichvu_item__text">

                        <div class="noidung_dichvu_item__text_1">
                            <?php echo $danhmucgames['tengame'] ?>
                        </div>
                        <div class="noidung_dichvu_item__text_2">
                            Còn lại: <?php echo $danhmucgames['soluongacc'] ?> 
                        </div>
                        <div class="noidung_dichvu_item__text_3"><a href="./index.php?controller=danhmucgame&action=show&iddanhmucgame=<?php echo $danhmucgames['id_danhmucgame'] ?>">
                                <div>MUA NGAY</div>
                            </a></div>


                    </div>


                </div>
            <?php endforeach; ?>


        </div>
        
    </div>


</div>
<?php include './views/footer.php'; ?>