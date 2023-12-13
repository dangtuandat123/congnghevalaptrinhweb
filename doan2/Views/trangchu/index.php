<?php include './views/header.php'; ?>


<link rel="stylesheet" href="./views/trangchu/css/trangchu.css">
<div class="body">
    <div class="noidung">
        <div class="noidung__thumbnal">


            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->

                <script>
                    $('#myCarousel').carousel({
                        interval: 2000
                    });
                </script>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo $anhbia ?>" alt="" style="width:100%;">
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <!-- <span class="glyphicon glyphicon-chevron-left"></span> -->
                    <!-- <span class="sr-only">Previous</span> -->
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <!-- <span class="glyphicon glyphicon-chevron-right"></span> -->
                    <!-- <span class="sr-only">Next</span> -->
                </a>
            </div>


        </div>
        <marquee class="marquee"><b><?php echo $thongbao ?></b></marquee>

        <style>
            .marquee {
                font-size: 16px;
                background-color: #23cccc;
                margin-top: 10px;
                border-radius: 5px;
                color: white;

            }
        </style>
        <!-- <div class="noidung__tieude">
            <h2>Dịch vụ nổi bật</h2>
            <div class="noidung__tieude__line">

            </div>
        </div> -->
        <div class="noidung__tieude">
            <h2><b>NỔI BẬT</b></h2>
            <div class="noidung__tieude__line"></div>
        </div>
        <div class="noidung_danhsachdichvu_swiper">


            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

            <style>
                .swiper {
                    width: 100%;
                    height: 200%;
                }

                .swiper-slide {
                    text-align: center;
                    font-size: 18px;
                    background: #fff;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .swiper-slide img {
                    display: block;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 15px;
                }
            </style>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="./views/img/bia2/1.png" alt=""></div>
                    <div class="swiper-slide"><img src="./views/img/bia2/2.png" alt=""></div>
                    <div class="swiper-slide"><img src="./views/img/bia2/3.png" alt=""></div>
                    <div class="swiper-slide"><img src="./views/img/bia2/4.png" alt=""></div>

                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

            <script>
                var swiper = new Swiper(".mySwiper", {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    autoplay: {
                        delay: 1700, // Thời gian chuyển đổi giữa các slide (đơn vị: mili giây)
                        disableOnInteraction: false, // Tắt autoplay khi người dùng tương tác với Swiper
                    },
                    breakpoints: {
                        "@0.00": {
                            slidesPerView: 3,
                            spaceBetween: 10,
                        },
                        "@0.75": {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        "@1.00": {
                            slidesPerView: 4,
                            spaceBetween: 40,
                        },
                        "@1.50": {
                            slidesPerView: 4,
                            spaceBetween: 50,
                        },
                    },
                });
            </script>



        </div>
        <div class="noidung__tieude">
            <h2><b>DANH SÁCH GAME</b></h2>
            <div class="noidung__tieude__line"></div>
        </div>
        <div class="noidung_dichvu">
            <?php foreach ($danhmucgame as $danhmucgames) : ?>

                <div class="noidung_dichvu_item">

                    <!-- <a href="./index.php?controller=danhmucgame&action=show&iddanhmucgame=<?php echo $danhmucgames['id_danhmucgame'] ?>"><img src="<?php echo $danhmucgames['img'] ?>" alt=""></a>
                    <div class="noidung_dichvu_item__text">

                        <div class="noidung_dichvu_item__text_1">
                            <?php echo $danhmucgames['tengame'] ?>
                        </div>
                        <div class="noidung_dichvu_item__text_2">
                            Còn lại: <?php echo $danhmucgames['soluongacc'] ?>
                        </div>
                        <div class="noidung_dichvu_item__text_3">
                            <a href="./index.php?controller=danhmucgame&action=show&iddanhmucgame=<?php echo $danhmucgames['id_danhmucgame'] ?>">
                                <div>XEM TẤT CẢ</div>
                            </a>
                        </div>


                    </div> -->


                    <!-- <div>

                    </div> -->
                    <a href="./index.php?controller=danhmucgame&action=show&iddanhmucgame=<?php echo $danhmucgames['id_danhmucgame'] ?>" class="ag-courses-item_link" style="background-image: url(<?php echo $danhmucgames['img'] ?>);">
                        <div class="ag-courses-item_bg"></div>
                        <div class="thongtin">
                            <div class="ag-courses-item_title">
                                <?php echo $danhmucgames['tengame'] ?>
                            </div>

                            <div class="ag-courses-item_date-box">
                                Còn lại:
                                <span class="ag-courses-item_date">
                                    <?php
                                    $sql_2 = "SELECT COUNT(*) FROM taikhoangame WHERE tinhtrang = 'chuaban' AND id_danhmucgame = ".$danhmucgames['id_danhmucgame']."";
                                    $soluongacc = runSelectQuery($sql_2);
                                    echo $soluongacc[0]['COUNT(*)'];
                                    ?>
                                </span>
                            </div>

                        </div>




                    </a>






                </div>
            <?php endforeach; ?>


        </div>

    </div>


</div>
<?php include './views/footer.php'; ?>