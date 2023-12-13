<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title>Admin</title>

	<link rel="stylesheet" href="./views/admin/css/main.css">
	<link rel="stylesheet" href="./views/admin/css/sidebar.css">
	<link rel="stylesheet" href="./views/admin/css/header.css">

	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
	<script src="./views/admin/js/graph.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body onload="graph()">


	<!-- Thanh bên -->
	<input type="checkbox" id="nav-toggle">
	<div class="sidebar">
		<div class="sidebar-brand">
			<span><img width="40%" height="auto" src="./img/logo.png"></span>
		</div>

		<div class="sidebar-menu">
			<ul>
				<li>
					<a href="./index.php?controller=admin&action=bangdieukhien" class="active"><span class="las la-home"></span>
						<span>Bảng điều khiển</span></a>
				</li>

				<li>
					<a href="./index.php?controller=admin&action=quanlydanhmuc"><span class="las la-clipboard-list"></span>
						<span>Quản lý danh mục</span></a>
				</li>

				<li>
					<a href="./index.php?controller=admin&action=quanlytaikhoan"><span class="las la-clipboard-list"></span>
						<span>Quản lý tài khoản</span></a>
				</li>

				<li>
					<a href="./index.php?controller=admin&action=quanlynguoidung"><span class="las la-plus"></span>
						<span>Quản lý người dùng</span></a>
				</li>
				<li>
					<a href="./index.php?controller=admin&action=quanlydonhang" ><span class="las la-plus"></span>
						<span>Quản lý đơn hàng</span></a>
				</li>
				<li>
					<a href="./index.php?controller=admin&action=thongke"><span class="las la-plus"></span>
						<span>Thống kê</span></a>
				</li>
				<li>
					<a href="./index.php?controller=admin&action=caidat"><span class="las la-plus"></span>
						<span>Cài đặt</span></a>
				</li>
				<li>
					<a href="" onclick="dangXuat()"><span class="las la-sign-out-alt"></span>
						<span>Đăng Xuất</span></a>
				</li>
			</ul>
		</div>
	</div>


	<!-- Nội dung chính -->

	<div class="main-content">

		<!-- Phần header -->
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="las la-bars"></span>
				</label>

				Dashboard
			</h2>

			<div class="search-wrapper">
				<span class="las la-search"></span>
				<input type="search" placeholder="Tìm kiếm ở đây" />
			</div>

			

		</header>

		<!-- Phần main -->
		<main>
			<div class="cards">
				<div class="card-single">
					<div>
						<h1><?php echo $nguoidungdangkimoi ?></h1>
						<span>Người dùng đăng kí mới hôm nay</span>
					</div>

					<div>
						<span class="las la-user"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h1><?php echo $donhanghomnay ?></h1>
						<span>Đơn hàng hôm nay</span>
					</div>

					<div>
						<span class="las la-clipboard-list"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1><?php
							$doanhthuhomnay = (int)$doanhthuhomnay;
							$doanhthuhomnay = number_format($doanhthuhomnay, 0, '.', ',');
							echo $doanhthuhomnay;
							?> VNĐ</h1>
						<span>Doanh thu hôm nay</span>
					</div>

					<div>
						<span class="las la-user"></span>
					</div>
				</div>
			</div>
			<h2 class="title_atm">
				Đơn hàng gần đây
			</h2>
			<table class="table" style="font-size: 14px;">
				<thead>
					<tr>
						<th>
							MẪ ĐƠN HÀNG
						</th>
						<th>
							NGƯỜI DÙNG
						</th>
						<th>
							MÃ TÀI KHOẢN
						</th>
						<th>
							GAME
						</th>
						<th>
							GIÁ TIỀN
						</th>
						<th>
							THANH TOÁN QUA
						</th>
						<th>
							THỜI GIAN MUA
						</th>
					</tr>
				</thead>



				<?php foreach ($donhangganday as $donhanggandays) : ?>

					<tr>
						<th>
							<?php echo $donhanggandays['id_donhang'] ?>
						</th>
						<th>
							<?php echo $donhanggandays['taikhoan'] ?>
						</th>
						<th>
							<?php echo $donhanggandays['id_taikhoangame'] ?>
						</th>
						<th>
							<?php echo $donhanggandays['tengame'] ?>

						</th>
						<th>

							<?php
							$sotien = (int)$donhanggandays['giatien'];
							$sotien = number_format($sotien, 0, '.', ',');
							echo $sotien;
							?> VNĐ
						</th>
						<th>
							<?php echo $donhanggandays['phuongthucthanhtoan'] ?>
						</th>
						<th>
							<?php echo $donhanggandays['thoigianmua'] ?>
						</th>
					</tr>
				<?php endforeach; ?>

			</table>

			<div class="recent-grid">
				<div class="graph-card">
					<h3 class="section-head">Doanh thu tháng này</h3>
					<div class="graph-content">
						<div class="graph-head">
							<!-- <div class="icon">
								<span class="las la-eye text-main"></span>
							</div> -->
							<!-- <div class="graph-select">
								<select name="" id="">
									<option value="">Tháng 1</option>
									<option value="">Tháng 2</option>
									<option value="">Tháng 3</option>
									<option value="">Tháng 4</option>
									<option value="">Tháng 5</option>
									<option value="" selected>Tháng 6</option>
									<option value="">Tháng 7</option>
									<option value="">Tháng 8</option>
									<option value="">Tháng 9</option>
									<option value="">Tháng 10</option>
									<option value="">Tháng 11</option>
									<option value="">Tháng 12</option>
								</select>
							</div> -->
						</div>

						<div class="graph-board">
							<canvas id="revenueChart">
							</canvas>

						</div>
					</div>

				</div>
			</div>
			<?php
			// Đặt múi giờ
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$so_ngay_trong_thang = date('t');
			$first_day_of_month = date("Y-m-01");

			for ($i = 0; $i < (int)$so_ngay_trong_thang; $i++) {
				// Tạo timestamp cho ngày hiện tại
				$current_day_timestamp = strtotime($first_day_of_month . " +" . $i . " days");

				// Chuyển timestamp thành định dạng "Y-m-d"
				$current_day = date("Y-m-d", $current_day_timestamp);

				// echo $current_day . "<br>";
			}
			$chuoi = ""; // Khởi tạo chuỗi trống

			for ($i = 1; $i <= (int)$so_ngay_trong_thang; $i++) {
				$chuoi .= '"' . $i . '",'; // Thêm số và dấu ngoặc kép vào chuỗi
			}

			$chuoi = rtrim($chuoi, ','); // Loại bỏ dấu ',' cuối cùng

			?>
			<script>
				function graph() {
					let ctx = document.querySelector("#revenueChart");
					ctx.height = 150;

					let revChart = new Chart(ctx, {
						type: "line",
						data: {
							labels: [<?php echo $chuoi; ?>],
							datasets: [{
								label: "VNĐ",
								borderColor: "#DD2F6E",
								borderWidth: "3",
								backgroundColor: "rgba(235, 247, 245, 0.5)",
								data: [<?php echo $doanhthuthangnay; ?>]
							}]
						},
						options: {
							responsive: true,
							tooltips: {
								intersect: false,
								node: "index",
							}
						}
					});

				}
			</script>





		</main>
	</div>


</body>


</html>