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
	<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>


</head>

<body>


	<!-- Thanh bên -->
	<input type="checkbox" id="nav-toggle">
	<div class="sidebar">
		<div class="sidebar-brand">
			<span><img width="40%" height="auto" src="./img/logo.png"></span>
		</div>

		<div class="sidebar-menu">
			<ul>
				<li>
					<a href="./index.php?controller=admin&action=bangdieukhien"><span class="las la-home"></span>
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
					<a href="./index.php?controller=admin&action=quanlydonhang" class="active"><span class="las la-plus"></span>
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
						<h1><?php echo $sodonhang; ?></h1>
						<span>Tổng đơn hàng</span>
					</div>

					<div>
						<span class="las la-user"></span>
					</div>
				</div>


				<!-- <div class="card-single" >
					<div>
						<h1>sd</h1>
						<span>Số tài khoản đã bán</span>
					</div>

					<div>
						<span class="las la-money-bill"></span>
					</div>
				</div> -->
			</div>
			
			<h2 style="color: white;"><b>HÓA ĐƠN</b></h2>

			<form action="./index.php" method="get" class="form_quanlytaikhoanloc_3">
				<input type="hidden" name="controller" value="admin">
				<input type="hidden" name="action" value="quanlydonhang">
				<input type="hidden" name="thaotac" value="lochoadon">
				<div class="div_input">
					<span>Người dùng</span>
					<input type="text" name="nguoidung" placeholder=" Tên người dùng">
				</div>
				
				<div class="div_input">
					<span>Tình trạng</span>
					<select name="tinhtrang" id="" style="width: 100%">
						<option style="display: none;" value="khongchon" selected disabled>Không chọn</option>
						<option value="Chưa thanh toán">Chưa thanh toán</option>
						<option value="Thành công">Thành công</option>

						
					</select>
				</div>
				<div class="div_input">
					<span>Ngày bắt đầu</span>
					<input type="datetime-local" name="ngaybatdau">
				</div>
				<div class="div_input">
					<span>Ngày kết thúc</span>
					<input type="datetime-local" name="ngayketthuc">
				</div>
				<div>
					<input type="submit" class="input_submit" style="margin: 0px;" value="Xác nhận">
					<a href="./index.php?controller=admin&action=quanlynguoidung"><button class="input_submit" style="margin: 0px;">Tất cả</button></a>
				</div>

			</form>

			<div style="width: 100%; margin: 10px 0px; max-height: 400px; background-color: white; overflow: auto;">
				<table class="table" style="font-size: 14px;margin-top: 0px;">
					<thead>
						<tr>
							<th>
								MẪ HÓA ĐƠN
							</th>
							<th>
								NGƯỜI DÙNG
							</th>
							<th>
								THỜI GIAN TẠO
							</th>
							<th>
								GIÁ TIỀN
							</th>
							<th>
								PHƯƠNG THỨC
							</th>
							<th>
								TÌNH TRẠNG
							</th>

						</tr>
					</thead>

					<?php foreach ($tonghoadon as $tonghoadons) : ?>

						<tr>
							<th>
								<?php echo $tonghoadons['id_hoadon'] ?>
							</th>
							<th>
								<?php echo $tonghoadons['taikhoan'] ?>
							</th>
							<th>
								<?php echo $tonghoadons['thoigiantao'] ?>
							</th>

							<th>
								<?php
								$sotien = (int)$tonghoadons['giatien'];
								$sotien = number_format($sotien, 0, '.', ',');
								echo $sotien;
								?> VNĐ
							</th>
							<th>
								<?php echo $tonghoadons['phuongthucthanhtoan'] ?>
							</th>
							<th>

								<?php if ($tonghoadons['tinhtrang'] != "Chưa thanh toán") {
									echo '<span style="color: green;">Thành công</span>';
								} else {
									echo '<span style="color: red;">Chưa thanh toán</span>';
								} ?>
							</th>
						</tr>
					<?php endforeach; ?>

				</table>
			</div>







			<div style="width: 100%;display: flex;justify-content: center;">


				<?php

				$page =  (int)($_GET['page'] ?? "1");
				$count = 1;
				$count_2 = 1;
				// $trangthai = $_REQUEST['trangthai'] ?? null;
				// $danhmucgame = $_REQUEST['danhmucgame'] ?? null;

				// if ($trangthai != null) {
				// 	$trangthai = "&trangthai=" . $trangthai;
				// }
				// if ($danhmucgame != null) {
				// 	$danhmucgame = "&danhmucgame=" . $danhmucgame;
				// }

				?>
				<!-- <div class="pagination">
					<a class="" href="<?php if ($page > 1) echo "./index.php?controller=admin&action=quanlynguoidung&page=" . $page - 1 ?>">&laquo;</a>
					<a class="<?php if ($page == 1) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlynguoidung&page=1" ?>">1</a>
					<?php if ($maxpage > 6) : ?>
						<?php if ($page >= 1 && $page < 5) : ?>

							<?php for ($i = 2; $i < $page + 6; $i++) : ?>
								<?php if ($count_2 == 5) : ?>
									<a class="">. . .</a>
								<?php else : ?>
									<a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlynguoidung&page=$i" ?>"><?php echo $i ?></a>
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
									<a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlynguoidung&page=$i" ?>"><?php echo $i ?></a>
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
									<a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlynguoidung&page=$i" ?>"><?php echo $i ?></a>
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

							<a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlynguoidung&page=$i" ?>"><?php echo $i ?></a>

						<?php endfor; ?>
					<?php endif; ?>
					<?php if ($maxpage != 0 && $maxpage != 1) : ?>
						<a class="<?php if ($maxpage == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlynguoidung&page=$maxpage" ?>"><?php echo $maxpage ?></a>
					<?php endif; ?>
					<a class="" href="<?php if ($page < $maxpage) echo "./index.php?controller=admin&action=quanlynguoidung&page=" . $page + 1. ?>">&raquo;</a>
				</div> -->
			</div>

		</main>
	</div>


</body>


</html>