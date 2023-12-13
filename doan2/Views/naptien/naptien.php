<?php

?>
<?php include './views/header.php'; ?>
<link rel="stylesheet" href="./views/naptien/css/naptien.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<div class="body">
    <div class="noidung">
        <div style="display:flex; justify-content: center;width: 100%; height: 100%;">
            <div class="noidung__naptien">

                <div class="noidung__naptien_1">
                    <img src="<?php echo $phuongthucthanhtoan['img'] ?>" alt="">
                    <div>
                        Ngân hàng: <?php echo $phuongthucthanhtoan['tennganhang'] ?>
                        <hr>
                        Số tài khoản: <?php echo $phuongthucthanhtoan['sotaikhoan'] ?>
                        <hr>
                        Người thụ hưởng: <?php echo $phuongthucthanhtoan['nguoithuhuong'] ?>
                        <hr>
                        Số tiền cần nạp: <?php
                                            $sodu = (int)$sotiennap;
                                            $sodu = number_format($sodu, 0, '.', ',');
                                            echo $sodu; ?>
                        <span style="color: red;"><b>&nbsp;VNĐ</b></span>
                        <hr>
                        Nội dung chuyển khoản: <?php echo $noidung ?>
                    </div>
                    <script>
                        function countdownTimer() {

                            var timeLeft = 1200;
                            var timerId = setInterval(function() {
                                if (timeLeft <= 0) {
                                    clearInterval(timerId);
                                    window.location.href = './index.php?controller=naptien';

                                } else {
                                    var minutes = parseInt(timeLeft / 60, 10);
                                    var seconds = parseInt(timeLeft % 60, 10);

                                    minutes = minutes < 10 ? "0" + minutes : minutes;
                                    seconds = seconds < 10 ? "0" + seconds : seconds;

                                    document.getElementById('countdown').innerHTML = minutes + ":" + seconds;
                                    timeLeft--;
                                }
                            }, 1000);
                            var timerId_post = setInterval(function() {
                                if (timeLeft <= 0) {
                                    clearInterval(timerId_post);
                                } else {
                                    getLsgd();
                                }
                            }, 5000);
                        }

                        function getLsgd() {
                        var xhr = new XMLHttpRequest();
                            xhr.open('POST', './index.php', true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    console.error('Phản hồi từ máy chủ:', this.responseText);
                                    var response = this.responseText.replace(/<[^>]*>/g, '').trim()
                                    if(response=='thanhcong'){
                                        window.location.href = './index.php?controller=naptien&thongbaonaptien=napthanhcong&sotien=1200';
                                    }else if(response=='khongthanhcong'){
                                        window.location.href = './index.php?controller=naptien';
                                    }
                                }
                            };
                            var data = 'controller=naptien&action=xulynaptien_Mbbank&id_nguoidung=<?php echo $idnguoidung?>&sotiennap=<?php echo $sotiennap?>&noidung=<?php echo $noidung?>';
                            xhr.send(data);


                        }
                        // Khởi tạo đồng hồ đếm ngược
                        countdownTimer();
                        var noidung = "<?php echo $noidung ?>";
                    </script>


                    <div id="countdown">00:00</div>


                </div>
                <div class="noidung__naptien_2">
                    <img src="https://api.vietqr.io/image/970422-<?php echo $phuongthucthanhtoan['sotaikhoan'] ?>-LIQqtjH.jpg?&amount=<?php echo $sotiennap ?>&addInfo=<?php echo $noidung ?>" alt="">
                </div>

            </div>





        </div>







    </div>


</div>

<?php include './views/footer.php'; ?>