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
					<a href="./index.php?controller=admin&action=quanlydonhang"><span class="las la-plus"></span>
						<span>Quản lý đơn hàng</span></a>
				</li>
				<li>
					<a href="./index.php?controller=admin&action=thongke"><span class="las la-plus"></span>
						<span>Thống kê</span></a>
				</li>
				<li>
					<a href="./index.php?controller=admin&action=caidat" class="active"><span class="las la-plus"></span>
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
			<h2 style="color: white;"><b>GIAO DIỆN VÀ THÔNG BÁO</b></h2>
			<form action="./index.php?controller=admin&action=caidat&thaotac=giaodienvathongbao" method="post" style="background-color: white; padding: 10px; border-radius: 10px;" enctype="multipart/form-data">

				<div class="div_input" style="width: 500px;">
					<span>Tên trang web</span>
					<input style="" type="text" name="tentrangweb" value="<?php echo $caidat['tentrangweb'] ?>">
				</div>

				<div class="div_input" style="width: 500px; margin-top:10px;">
					<span>Thông báo</span>
					<input style="" type="text" name="thongbao" value=" <?php echo $caidat['thongbao'] ?>">
				</div>

				<h4>Ảnh bìa</h4>
				<input type="file" name="anhbia" accept="image/*" class="input_upload" onchange="previewImage(event)">
				<div id="imagePreview" style="max-width: 100px; max-height: 100px">

					<img src="<?php echo $caidat['anhbia'] ?>" alt="" style="height: 100px; width: 500px">

				</div>
				<input type="file" name="logo" accept="image/*" class="input_upload" onchange="previewImageLogo(event)">
				<div id="imagePreviewLogo" style="max-width: 100px; max-height: 200px">

					<img src="<?php echo $caidat['logo'] ?>" alt="" style="height: 100px; width: 200px">

				</div>

				<script>
					function previewImage(event) {
						var input = event.target;

						var reader = new FileReader();
						reader.onload = function() {
							var dataURL = reader.result;
							var imagePreview = document.getElementById('imagePreview');

							// Tạo một thẻ img với kích thước giới hạn là 100x100 pixels
							var imgElement = document.createElement('img');
							imgElement.src = dataURL;
							imgElement.alt = 'Preview';
							imgElement.style.maxWidth = '100px';
							imgElement.style.maxHeight = '500px';

							// Xóa nội dung cũ của thẻ div và thêm hình ảnh mới
							imagePreview.innerHTML = '';
							imagePreview.appendChild(imgElement);
						};
						reader.readAsDataURL(input.files[0]);
					}

					function previewImageLogo(event) {
						var input = event.target;

						var reader = new FileReader();
						reader.onload = function() {
							var dataURL = reader.result;
							var imagePreview = document.getElementById('imagePreviewLogo');

							// Tạo một thẻ img với kích thước giới hạn là 100x100 pixels
							var imgElement = document.createElement('img');
							imgElement.src = dataURL;
							imgElement.alt = 'Preview';
							imgElement.style.maxWidth = '100px';
							imgElement.style.maxHeight = '200px';

							// Xóa nội dung cũ của thẻ div và thêm hình ảnh mới
							imagePreview.innerHTML = '';
							imagePreview.appendChild(imgElement);
						};
						reader.readAsDataURL(input.files[0]);
					}
				</script>

				<div style="margin-top: 10px;">
					<input type="submit" class="input_submit" style="margin: 0px;" value="Lưu">
				</div>

			</form>

			<h2 style="color: white;"><b>TRANG LIÊN HỆ</b></h2>
			<form action="./index.php?controller=admin&action=caidat&thaotac=lienhe" method="post" style="background-color: white; padding: 10px; border-radius: 10px;">
				<h3><b>Nhập Plugin</b></h3>
				<textarea name="editor1"><?php echo $lienhe?></textarea>
				<script>
					CKEDITOR.replace('editor1');
				</script>

				<div style="margin-top: 10px;">
					<input type="submit" class="input_submit" style="margin: 0px;" value="Lưu">
				</div>

			</form>




			<h2 style="color: white;"><b>PLUGIN CHAT</b></h2>
			<form action="./index.php?controller=admin&action=caidat&thaotac=plugin" method="post" style="background-color: white; padding: 10px; border-radius: 10px;">
				<h3><b>Nhập Plugin</b></h3>
				<textarea style="width: 100%;" name="plugin" id="" rows="10"><?php echo $caidat['plugin_chat'] ?></textarea>

				<div style="margin-top: 10px;">
					<input type="submit" class="input_submit" style="margin: 0px;" value="Lưu">
				</div>

			</form>

			<h2 style="color: white;"><b>PHƯƠNG THỨC THANH TOÁN</b></h2>
			<form action="./index.php?controller=admin&action=caidat&thaotac=vnpay" method="post" style="background-color: white; padding: 10px; border-radius: 10px;">
				<h3><b>VNPAY</b></h3>
				<div class="div_input" style="width: 500px;">
					<span>Terminal Id</span>
					<input style="" type="text" name="terminal_id" placeholder="" value="<?php echo $vnpay['terminal_id'] ?>">
				</div>

				<div class="div_input" style="width: 500px; margin-top:10px;">
					<span>Secret key</span>
					<input style="" type="text" name="secret_key" placeholder=" " value="<?php echo $vnpay['secret_key'] ?>">
				</div>
				<div style="margin-top: 10px;">
					<input type="submit" class="input_submit" style="margin: 0px;" value="Lưu">
				</div>


			</form>
			<form action="./index.php?controller=admin&action=caidat&thaotac=momo" method="post" style="background-color: white; padding: 10px; border-radius: 10px; margin-top: 10px;">

				<h3><b>MOMO</b></h3>
				<div class="div_input" style="width: 500px;">
					<span>PartnerCode</span>
					<input style="" type="text" name="partnercode" placeholder=" " value="<?php echo $momo['partnercode'] ?>">
				</div>

				<div class="div_input" style="width: 500px; margin-top:10px;">
					<span>AccessKey</span>
					<input style="" type="text" name="accesskey" placeholder=" " value="<?php echo $momo['accesskey'] ?>">
				</div>
				<div class="div_input" style="width: 500px; margin-top:10px;">
					<span>SecretKey</span>
					<input style="" type="text" name="secretkey" placeholder=" " value="<?php echo $momo['secretkey'] ?>">
				</div>
				<div style="margin-top: 10px;">
					<input type="submit" class="input_submit" style="margin: 0px;" value="Lưu">
				</div>

			</form>

			<h2 style="color: white;"><b>TRẠNG THÁI TRANG</b></h2>
			<form action="./index.php?controller=admin&action=caidat&thaotac=trangthai" method="post" style="background-color: white; padding: 10px; border-radius: 10px;">

				<div class="div_input" style="width: 500px; margin-top:10px;">
					<span>Trạng thái</span>
					<select name="trangthai" id="" required>
						<option value="baotri" <?php if ($caidat['trangthai'] == "baotri") {
													echo "selected";
												} ?>>Bảo trì</option>
						<option value="khongbaotri" <?php if ($caidat['trangthai'] == "khongbaotri") {
														echo "selected";
													} ?>>Không Bảo trì</option>
					</select>
				</div>
				<div style="margin-top: 10px;">
					<input type="submit" class="input_submit" style="margin: 0px;" value="Lưu">
				</div>

			</form>








		</main>
	</div>


</body>


</html>