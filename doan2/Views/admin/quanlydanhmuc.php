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
					<a href="./index.php?controller=admin&action=quanlydanhmuc" class="active"><span class="las la-clipboard-list"></span>
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

			<!-- <div class="user-wrapper">
				<div>
					<h4>Admin</h4>

				</div>
			</div> -->

		</header>

		<!-- Phần main -->
		<main>
			<div class="cards">
				<div class="card-single">
					<div>
						<h1><?php echo $tongsodanhmuc; ?></h1>
						<span>Tổng số danh mục</span>
					</div>

					<div>
						<span class="las la-user"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h1><?php echo $tongsodanhmuchoatdong; ?></h1>
						<span>Danh mục đang hoạt động</span>
					</div>

					<div>
						<span class="las la-clipboard-list"></span>
					</div>
				</div>

				<div class="card-single" style="display: none;">
					<div>
						<h1>1.935$</h1>
						<span>Doanh thu tháng</span>
					</div>

					<div>
						<span class="las la-money-bill"></span>
					</div>
				</div>
			</div>

			<h2 class="title_atm">
				DANH MỤC GAME
			</h2>

			<div class="noidung__search">

				<form class="form_search" action="" method="GET">

					<input type="hidden" name="controller" value="admin">
					<input type="hidden" name="action" value="quanlydanhmuc">
					<input type="hidden" name="thaotac" value="timkiem">
					<input type="hidden" name="iddanhmucgame" value="<?php echo $id_danhmucgame; ?>">

					<div style="grid-area: aa;">
						<span>TÊN GAME</span>
						<input class="noidung__search__input" placeholder="TÊN GAME" name="tukhoa" type="text">
					</div>
					<div style="grid-area: bb;">
						<span>TRẠNG THÁI</span>
						<select name="trangthai" id="" class="">
							<option style="display: none;" value="khongchon" selected disabled>Không chọn</option>
							<option value="Bật">Bật</option>
							<option value="Tắt">Tắt</option>

						</select>
					</div>

					<div style="grid-area: ee;">
						<input class="noidung__search__submit" type="submit" value="Tìm kiếm">
						<a href="./index.php?controller=admin&action=quanlydanhmuc" id="noidung__search__submit_all">Tất cả</a>
					</div>

				</form>

			</div>
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Thêm danh mục</button>

			<!-- Modal them danh muc -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Thêm danh mục</h4>
						</div>
						<div class="modal-body">

							<form action="./index.php?controller=admin&action=quanlydanhmuc&thaotac=themdanhmuc" method="post" enctype="multipart/form-data">
								<div class="div_input">
									<span>Tên game</span>
									<input type="text" required name="tengame">
								</div>
								<h4>Thumbnal</h4>
								<input type="file" name="thumbnal" accept="image/*" class="input_upload" required>
								<h4>Background</h4>
								<input type="file" name="background" accept="image/*" class="input_upload" required>
								<div class="div_input">
									<span>Trạng thái</span>
									<select name="trangthai" id="">
										<option value="Bật" selected>Bật</option>
										<option value="Tắt">Tắt</option>
									</select>

								</div>
								<input type="submit" class="input_submit" value="Xác nhận">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<table class="table" style="font-size: 14px;">
				<thead>
					<tr>
						<th>
							ID
						</th>
						<th>
							TÊN GAME
						</th>
						<th>
							THUMBNAL
						</th>
						<th>
							BACKGROUND
						</th>
						<th>
							TRẠNG THÁI
						</th>
						<th>
							THAO TÁC
						</th>

					</tr>
				</thead>
				<?php foreach ($danhmucgame as $danhmucgames) : ?>
					<tr>
						<th><?php echo $danhmucgames['id_danhmucgame'] ?></th>
						<th><?php echo $danhmucgames['tengame'] ?></th>
						<th><img src="<?php echo $danhmucgames['img'] ?>" alt=""> </th>
						<th><img src="<?php echo $danhmucgames['img_background'] ?>" alt=""></th>
						<th><?php echo $danhmucgames['trangthai'] ?></th>
						<th>


							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#danhmucgame<?php echo $danhmucgames['id_danhmucgame'] ?>">Chỉnh sửa</button>

							<!-- Modal capnhap -->
							<div class="modal fade" id="danhmucgame<?php echo $danhmucgames['id_danhmucgame'] ?>" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Cập nhập danh mục</h4>
										</div>
										<div class="modal-body">

											<form action="./index.php?controller=admin&action=quanlydanhmuc&thaotac=capnhapdanhmuc" method="post" enctype="multipart/form-data">
												<div class="div_input">
													<span>Tên game</span>
													<input type="text" required name="tengame" value="<?php echo $danhmucgames['tengame'] ?>">
													<input type="hidden" name="id_danhmucgame" value="<?php echo $danhmucgames['id_danhmucgame'] ?>">
													<input type="hidden" name="duongdan_background" value="<?php echo $danhmucgames['img_background'] ?>">
													<input type="hidden" name="duongdan_thumbnal" value="<?php echo $danhmucgames['img'] ?>">

												</div>
												<h4>Thêm mới thumbnal</h4>
												<input type="file" name="thumbnal" accept="image/*" class="input_upload">
												<h4>Thumbnal cũ</h4>
												<img src="<?php echo $danhmucgames['img'] ?>" alt="" style="width: 100px; height: 100px;">
												<h4>Thêm mới Background</h4>
												<input type="file" name="background" accept="image/*" class="input_upload">
												<h4>Background cũ</h4>
												<img src="<?php echo $danhmucgames['img_background'] ?>" style="width: 100px; height: 100px;" alt="">
												<div class="div_input" style="margin-top: 5px;">
													<span>Trạng thái</span>
													<select name="trangthai" id="">
														<option value="Bật" <?php if ($danhmucgames['trangthai'] == "Bật") echo "selected" ?>>Bật</option>
														<option value="Tắt" <?php if ($danhmucgames['trangthai'] == "Tắt") echo "selected" ?>>Tắt</option>
													</select>

												</div>
												<input type="submit" class="input_submit" value="Cập nhập">
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>




							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#danhmucgamexoa<?php echo $danhmucgames['id_danhmucgame'] ?>">Xóa</button>

							<!-- Modal xoa -->
							<div class="modal fade" id="danhmucgamexoa<?php echo $danhmucgames['id_danhmucgame'] ?>" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Xóa danh mục</h4>
										</div>
										<div class="modal-body">

											<form action="./index.php?controller=admin&action=quanlydanhmuc&thaotac=xoadanhmuc" method="post">
												<h3>Bạn có muốn xóa danh mục #<?php echo $danhmucgames['id_danhmucgame'] ?></h3>
												<div class="div_input">

													<input type="hidden" name="id_danhmucgame" value="<?php echo $danhmucgames['id_danhmucgame'] ?>">
													<input type="hidden" name="duongdan_background" value="<?php echo $danhmucgames['img_background'] ?>">
													<input type="hidden" name="duongdan_thumbnal" value="<?php echo $danhmucgames['img'] ?>">

												</div>
												<input type="submit" class="input_submit" value="Đồng ý">
												<button data-dismiss="modal" class="input_submit">Không</button>

											</form>
										</div>
									
									</div>
								</div>
							</div>





						</th>
					</tr>
				<?php endforeach; ?>






			</table>





		</main>
	</div>


</body>


</html>