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
					<a href="./index.php?controller=admin&action=quanlynguoidung" class="active"><span class="las la-plus"></span>
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
						<h1><?php echo $tongsonguoidung ?></h1>
						<span>Tổng người dùng</span>
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
			<form action="./index.php" method="get" class="form_quanlytaikhoanloc_2">
				<input type="hidden" name="controller" value="admin">
				<input type="hidden" name="action" value="quanlynguoidung">
				<div class="div_input">
					<span>Tìm kiếm</span>
					<input type="text" name="tukhoa" placeholder="Username,SĐT,Email">
				</div>

				<div>
					<input type="submit" class="input_submit" style="margin: 0px;" value="Xác nhận">
					<a href="./index.php?controller=admin&action=quanlynguoidung"><button class="input_submit" style="margin: 0px;">Tất cả</button></a>
				</div>

			</form>




			<table class="table" style="font-size: 14px;">
				<thead>
					<tr>
						<th>
							ID
						</th>
						<th>
							USERNAME
						</th>
						<th>
							SỐ ĐIỆN THOẠI
						</th>
						<th>
							EMAIL
						</th>
						<th>
							NGÀY ĐĂNG KÍ
						</th>
						<th>
							TRẠNG THÁI
						</th>
						<th>
							THAO TÁC
						</th>

					</tr>
				</thead>
				<?php foreach ($nguoidungAll as $nguoidungAlls) : ?>
					<tr>
						<th><?php echo $nguoidungAlls['id_nguoidung'] ?></th>
						<th><?php echo $nguoidungAlls['taikhoan'] ?></th>
						<th><?php if ($nguoidungAlls['sodienthoai'] != "") {
								echo $nguoidungAlls['sodienthoai'];
							} else {
								echo '<span style="color: red;">Chưa cập nhập</span>';
							} ?></th>
						<th><?php if ($nguoidungAlls['email'] != "") {
								echo $nguoidungAlls['email'];
							} else {
								echo '<span style="color: red;">Chưa cập nhập</span>';
							} ?></th>
						<th><?php echo $nguoidungAlls['ngaydangki'] ?></th>
						<th><?php if ($nguoidungAlls['sodienthoai'] != "Bình thường") {
								echo '<span style="color: green;">Bình thường</span>';
							} else {
								echo '<span style="color: red;">Chặn khỏi hệ thống</span>';
							} ?></th>
						<th></th>


					</tr>
				<?php endforeach; ?>






			</table>








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
				<div class="pagination">
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
				</div>
			</div>

		</main>
	</div>


</body>


</html>