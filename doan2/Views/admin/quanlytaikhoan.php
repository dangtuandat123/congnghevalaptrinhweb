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
					<a href="./index.php?controller=admin&action=quanlytaikhoan" class="active"><span class="las la-clipboard-list"></span>
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
						<h1><?php echo $tongsotaikhoan ?></h1>
						<span>Tổng số tài khoản game</span>
					</div>

					<div>
						<span class="las la-user"></span>
					</div>
				</div>



				<div class="card-single" >
					<div>
						<h1><?php echo $tongsotaikhoandaban ?></h1>
						<span>Số tài khoản đã bán</span>
					</div>

					<div>
						<span class="las la-money-bill"></span>
					</div>
				</div>
			</div>


			<form action="./index.php" method="get" class="form_quanlytaikhoanloc_2">
				<input type="hidden" name="controller" value="admin">
				<input type="hidden" name="action" value="quanlytaikhoan">
				<div class="div_input">
					<span>Trạng thái</span>
					<select name="tinhtrang" id="">
						<option style="display: none;" value="khongchon" selected disabled>Không chọn</option>
						<option value="chuaban">Chưa bán</option>
						<option value="daban">Đã bán</option>
					</select>

				</div>
				<div class="div_input">
					<span>Danh mục game</span>
					<select name="danhmucgame" id="">
						<option style="display: none;" value="khongchon" selected disabled>Không chọn</option>
						<?php foreach ($showdanhmucgame as $showdanhmucgames) : ?>
							<option value="<?php echo $showdanhmucgames['id_danhmucgame'] ?>"><?php echo $showdanhmucgames['tengame'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<input type="submit" class="input_submit" style="margin: 0px;" value="Xác nhận">
					<a href="./index.php?controller=admin&action=quanlytaikhoan"><button class="input_submit" style="margin: 0px;">Tất cả</button></a>
				</div>

			</form>
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Thêm tài khoản</button>

			<!-- Modal them danh muc -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Thêm tài khoản</h4>
						</div>
						<div class="modal-body">

							<form action="./index.php?controller=admin&action=quanlytaikhoan&thaotac=themtaikhoan" method="post" enctype="multipart/form-data">
								<div class="div_input">
									<span>Mô tả ngắn</span>
									<input type="text" required name="motangan">
								</div>
								<div class="div_2_input">
									<div class="div_input">
										<span>Giá gốc</span>
										<input type="number" required name="giagoc" id="giagoc" oninput="tinhGiaBanRa()">
									</div>
									<div class="div_input">
										<span>% giảm giá</span>
										<input type="number" required name="giamgia" id="giamgia" oninput="tinhGiaBanRa()">
									</div>
								</div>
								<div class="div_giabanra" style="font-size: 17px; margin-top: 10px; color: red; font-weight: 600;">
									Giá bán ra: <span id="giabanra">0 VNĐ</span>
								</div>

								<script>
									function tinhGiaBanRa() {
										// Lấy giá trị từ các trường input và chuyển đổi sang số nguyên
										var giaGoc = parseInt(document.getElementById("giagoc").value);
										var giamGia = parseInt(document.getElementById("giamgia").value);

										// Kiểm tra nếu giá gốc và % giảm giá là số nguyên và hợp lệ
										if (!isNaN(giaGoc) && !isNaN(giamGia) && giaGoc > 0 && giamGia >= 0 && giamGia <= 100) {
											// Tính giá bán ra theo công thức
											var giaBanRa = giaGoc - (giaGoc * giamGia / 100);

											// Làm tròn giá bán ra lên đến số nguyên gần nhất
											giaBanRa = Math.ceil(giaBanRa);

											// Định dạng số có dấu phẩy ngăn cách hàng nghìn và giữ hai chữ số thập phân
											var giaBanRaFormatted = giaBanRa.toLocaleString('en-US', {
												minimumFractionDigits: 0,
												maximumFractionDigits: 0
											});

											// Hiển thị kết quả
											document.getElementById("giabanra").innerHTML = giaBanRaFormatted + " VNĐ";
										} else {
											// Hiển thị thông báo nếu dữ liệu không hợp lệ
											document.getElementById("giabanra").innerHTML = "Dữ liệu không hợp lệ";
										}
									}
								</script>
								<div class="div_2_input">

									<div class="div_input" style="margin-top: 10px;">
										<span>Danh mục game</span>
										<select name="danhmucgame" id="" required>
											<?php foreach ($showdanhmucgame as $showdanhmucgames) : ?>
												<option value="<?php echo $showdanhmucgames['id_danhmucgame'] ?>"><?php echo $showdanhmucgames['tengame'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="div_input" style="margin-top: 10px;">
										<span>Loại đăng kí</span>
										<select name="loaidangki" id="" required>
											<option value="Đăng kí thật">Đăng kí thật</option>
											<option value="Đăng kí ảo">Đăng kí ảo</option>
										</select>
									</div>
								</div>

								<div class="div_2_input">
									<div class="div_input">
										<span>Tài khoản</span>
										<input type="number" required name="taikhoan">
									</div>
									<div class="div_input">
										<span>Mật khẩu</span>
										<input type="password" required name="matkhau">
									</div>
								</div>
								<div>
									<label for="editor1">Mô tả chi tiết</label>
									<textarea name="editor1"></textarea>
									<script>
										CKEDITOR.replace('editor1');
									</script>
								</div>



								<h4>Thumbnal</h4>
								<input type="file" name="thumbnal" accept="image/*" class="input_upload" required onchange="previewImage(event)">
								<div id="imagePreview" style="max-width: 100px; max-height: 100px"></div>

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
											imgElement.style.maxHeight = '100px';

											// Xóa nội dung cũ của thẻ div và thêm hình ảnh mới
											imagePreview.innerHTML = '';
											imagePreview.appendChild(imgElement);
										};
										reader.readAsDataURL(input.files[0]);
									}
								</script>
								<h4 id="h4_hinhanhsanpham">Hình ảnh sản phẩm</h4>

								<div id="inputContainer">

								</div>


								<div style="margin-bottom: 10px;">
									<a class="themhinhanh" onclick="themInput()">Thêm một ảnh</a>

								</div>
								<input type="hidden" name="soanh" id="soanh" value="0">


								<div class="div_input">
									<span>Trạng thái</span>
									<select name="tinhtrang" id="">
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

			<script>
				let inputCounter = 0;

				function themInput() {
					inputCounter++;
					// Tạo một div container cho input và nút xóa
					const container = document.createElement("div");
					container.classList.add("input-container");
					container.style.display = "grid";
					container.style.gridAutoColumns = "1fr";
					container.style.gridAutoRows = "1fr";
					container.style.gridTemplateColumns = "284.8px 110px";
					container.style.gridTemplateRows = "auto auto";
					container.style.gap = "0px 0px";
					container.style.gridTemplateAreas = `
 														". ."
 														". ."
															`;


					// Tạo input
					const input = document.createElement("input");
					input.type = "file";
					input.accept = "image/*";
					input.className = "input_upload";
					input.name = "anh" + inputCounter; // Sửa đổi trường "name" để cộng dần
					input.required = true; // Thêm trường required

					// Tạo nút xóa
					const btnXoa = document.createElement("button");
					btnXoa.textContent = "Xóa ảnh";
					btnXoa.style.margin = "10px";
					btnXoa.style.padding = "0px 10px";

					btnXoa.addEventListener("click", function() {
						container.remove(); // Xóa container khi nút xóa được nhấp
						capNhatTenInput();
						capNhatHinhAnhPreview();
					});

					// Tạo phần hiển thị ảnh preview
					const imagePreview = document.createElement("img");
					imagePreview.className = "image-preview";
					imagePreview.style.maxWidth = "100px";
					imagePreview.style.maxHeight = "100px";
					imagePreview.style.marginBottom = "10px";


					// Thêm input, nút xóa, và ảnh preview vào container
					container.appendChild(input);
					container.appendChild(btnXoa);
					container.appendChild(imagePreview);

					// Thêm container vào div chứa các input
					document.getElementById("inputContainer").appendChild(container);

					// Thêm sự kiện change cho input để hiển thị ảnh preview
					input.addEventListener("change", function(event) {
						hienThiAnhPreview(event, imagePreview);
					});

					capNhatTenInput();
					capNhatHinhAnhPreview();
				}

				function capNhatTenInput() {
					const containers = document.querySelectorAll(".input-container");
					const soanhInput = document.getElementById("soanh");
					const h4_hinhanhsanpham = document.getElementById("h4_hinhanhsanpham");

					h4_hinhanhsanpham.textContent = "Hình ảnh sản phẩm: " + containers.length;
					soanhInput.value = containers.length;

					containers.forEach(function(container, index) {
						const input = container.querySelector("input");
						input.name = "anh" + (index + 1);
					});
				}

				function hienThiAnhPreview(event, imagePreview) {
					const input = event.target;
					const file = input.files[0];

					if (file) {
						const reader = new FileReader();

						reader.onload = function(e) {
							imagePreview.src = e.target.result;
						};

						reader.readAsDataURL(file);
					} else {
						// Clear image preview if no file is selected
						imagePreview.src = "";
					}
				}

				function capNhatHinhAnhPreview() {
					const imagePreviewContainer = document.getElementById("imagePreviewContainer");
					imagePreviewContainer.innerHTML = ""; // Clear the existing previews

					const containers = document.querySelectorAll(".input-container");

					containers.forEach(function(container, index) {
						const input = container.querySelector("input");
						const file = input.files[0];

						if (file) {
							const imagePreview = document.createElement("img");
							imagePreview.className = "image-preview";
							imagePreview.style.maxWidth = "100px";
							imagePreview.style.maxHeight = "100px";

							const imagePreviewContainerItem = document.createElement("div");
							imagePreviewContainerItem.className = "image-preview-container";
							imagePreviewContainerItem.appendChild(imagePreview);

							imagePreviewContainer.appendChild(imagePreviewContainerItem);

							const reader = new FileReader();
							reader.onload = function(e) {
								imagePreview.src = e.target.result;
							};
							reader.readAsDataURL(file);
						}
					});
				}
			</script>







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
							GIÁ BÁN
						</th>
						<th>
							TÌNH TRẠNG
						</th>
						<th>
							THAO TÁC
						</th>
					</tr>
				</thead>
				<?php foreach ($taikhoangame as $taikhoangames) : ?>

					<tr>
						<th><?php echo $taikhoangames['id_taikhoangame'] ?></th>
						<th><?php echo $taikhoangames['tengame'] ?></th>
						<th>
							<img style="width: 100px; height: 100px;" src="<?php echo $taikhoangames['img'] ?>" alt="" srcset="">
						</th>
						<th>
							<?php
							$giagoc = (int)$taikhoangames['giatien'];
							$giamgia = (int)$taikhoangames['giamgia'];
							$sotien = $giagoc - (($giagoc * $giamgia) / 100);
							$sotien = number_format($sotien, 0, '.', ',');
							echo $sotien;
							?> VNĐ
						</th>
						<th>
							<?php echo $taikhoangames['tinhtrang'] ?>
						</th>
						<th>

							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#capnhaptaikhoan<?php echo $taikhoangames['id_taikhoangame'] ?>">Cập nhập</button>

							<!-- Modal capnhap tai khoan -->
							<div class="modal fade" id="capnhaptaikhoan<?php echo $taikhoangames['id_taikhoangame'] ?>" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Cập nhập tài khoản</h4>
										</div>
										<div class="modal-body">

											<form action="./index.php?controller=admin&action=quanlytaikhoan&thaotac=capnhaptaikhoan" method="post" enctype="multipart/form-data">
												<input type="hidden" name="id_taikhoangame" value="<?php echo $taikhoangames['id_taikhoangame'] ?>">
												<div class="div_input">
													<span>Mô tả ngắn</span>
													<input type="text" required name="motangan" value="<?php echo $taikhoangames['mota'] ?>">
												</div>
												<div class="div_2_input">
													<div class="div_input">
														<span>Giá gốc</span>
														<input type="number" required name="giagoc" value="<?php echo $taikhoangames['giatien'] ?>" id="giagoc<?php echo $taikhoangames['id_taikhoangame'] ?>" oninput="tinhGiaBanRa<?php echo $taikhoangames['id_taikhoangame'] ?>()">
													</div>
													<div class="div_input">
														<span>% giảm giá</span>
														<input type="number" required name="giamgia" value="<?php echo $taikhoangames['giamgia'] ?>" id="giamgia<?php echo $taikhoangames['id_taikhoangame'] ?>" oninput="tinhGiaBanRa<?php echo $taikhoangames['id_taikhoangame'] ?>()">
													</div>
												</div>
												<div class="div_giabanra<?php echo $taikhoangames['id_taikhoangame'] ?>" style="font-size: 17px; margin-top: 10px; color: red; font-weight: 600;">
													Giá bán ra: <span id="giabanra<?php echo $taikhoangames['id_taikhoangame'] ?>">0 VNĐ</span>
												</div>

												<script>
													function tinhGiaBanRa<?php echo $taikhoangames['id_taikhoangame'] ?>() {
														// Lấy giá trị từ các trường input và chuyển đổi sang số nguyên
														var giaGoc = parseInt(document.getElementById("giagoc<?php echo $taikhoangames['id_taikhoangame'] ?>").value);
														var giamGia = parseInt(document.getElementById("giamgia<?php echo $taikhoangames['id_taikhoangame'] ?>").value);

														// Kiểm tra nếu giá gốc và % giảm giá là số nguyên và hợp lệ
														if (!isNaN(giaGoc) && !isNaN(giamGia) && giaGoc > 0 && giamGia >= 0 && giamGia <= 100) {
															// Tính giá bán ra theo công thức
															var giaBanRa = giaGoc - (giaGoc * giamGia / 100);

															// Làm tròn giá bán ra lên đến số nguyên gần nhất
															giaBanRa = Math.ceil(giaBanRa);

															// Định dạng số có dấu phẩy ngăn cách hàng nghìn và giữ hai chữ số thập phân
															var giaBanRaFormatted = giaBanRa.toLocaleString('en-US', {
																minimumFractionDigits: 0,
																maximumFractionDigits: 0
															});

															// Hiển thị kết quả
															document.getElementById("giabanra<?php echo $taikhoangames['id_taikhoangame'] ?>").innerHTML = giaBanRaFormatted + " VNĐ";
														} else {
															// Hiển thị thông báo nếu dữ liệu không hợp lệ
															document.getElementById("giabanra<?php echo $taikhoangames['id_taikhoangame'] ?>").innerHTML = "Dữ liệu không hợp lệ";
														}
													}

													tinhGiaBanRa<?php echo $taikhoangames['id_taikhoangame'] ?>()
												</script>
												<div class="div_2_input">

													<div class="div_input" style="margin-top: 10px;">
														<span>Danh mục game</span>
														<select name="danhmucgame" id="" required>
															<?php foreach ($showdanhmucgame as $showdanhmucgames) : ?>
																<option value="<?php echo $showdanhmucgames['id_danhmucgame'] ?>" <?php if ($showdanhmucgames['id_danhmucgame'] == $taikhoangames['id_danhmucgame']) echo "selected" ?>><?php echo $showdanhmucgames['tengame'] ?></option>
															<?php endforeach; ?>
														</select>
													</div>
													<div class="div_input" style="margin-top: 10px;">
														<span>Loại đăng kí</span>
														<select name="loaidangki" id="" required>
															<option value="Đăng kí thật" <?php if ($taikhoangames['loaidangki'] == "Đăng kí thật") echo "selected" ?>>Đăng kí thật</option>
															<option value="Đăng kí ảo" <?php if ($taikhoangames['loaidangki'] != "Đăng kí thật") echo "selected" ?>>Đăng kí ảo</option>
														</select>
													</div>
												</div>
												<div class="div_2_input">
													<div class="div_input">
														<span>Tài khoản</span>
														<input type="text" required name="taikhoan" value="<?php echo $taikhoangames['username'] ?>">
													</div>
													<div class="div_input">
														<span>Mật khẩu</span>
														<input type="text" required name="matkhau" value="<?php echo $taikhoangames['password'] ?>">
													</div>
												</div>

												<div>
													<label for="editor<?php echo $taikhoangames['id_taikhoangame'] ?>">Mô tả chi tiết</label>
													<textarea name="editor<?php echo $taikhoangames['id_taikhoangame'] ?>">

													<?php echo $taikhoangames['motachitiet'] ?>
													</textarea>
													<script>
														CKEDITOR.replace('editor<?php echo $taikhoangames['id_taikhoangame'] ?>');
													</script>
												</div>

												<h4>Thumbnal</h4>
												<input type="file" name="thumbnal" accept="image/*" class="input_upload" onchange="previewImage<?php echo $taikhoangames['id_taikhoangame'] ?>(event)">
												<div id="imagePreview<?php echo $taikhoangames['id_taikhoangame'] ?>" style="max-width: 100px; max-height: 100px">
													<img src="<?php echo $taikhoangames['img'] ?>" alt="" style="height: 100px; width: 100px;">
												</div>

												<script>
													function previewImage<?php echo $taikhoangames['id_taikhoangame'] ?>(event) {
														var input = event.target;

														var reader = new FileReader();
														reader.onload = function() {
															var dataURL = reader.result;
															var imagePreview = document.getElementById('imagePreview<?php echo $taikhoangames['id_taikhoangame'] ?>');

															// Tạo một thẻ img với kích thước giới hạn là 100x100 pixels
															var imgElement = document.createElement('img');
															imgElement.src = dataURL;
															imgElement.alt = 'Preview';
															imgElement.style.maxWidth = '100px';
															imgElement.style.maxHeight = '100px';

															// Xóa nội dung cũ của thẻ div và thêm hình ảnh mới
															imagePreview.innerHTML = '';
															imagePreview.appendChild(imgElement);
														};
														reader.readAsDataURL(input.files[0]);
													}
												</script>
												<h4 id="h4_hinhanhsanpham<?php echo $taikhoangames['id_taikhoangame'] ?>">Hình ảnh sản phẩm</h4>
												<div id="inputContainer<?php echo $taikhoangames['id_taikhoangame'] ?>">
													<!-- Các input sẽ được thêm vào đây -->
												</div>
												<div id="imagePreviewContainer<?php echo $taikhoangames['id_taikhoangame'] ?>"></div>

												<div style="margin-bottom: 10px;">
													<a class="themhinhanh" onclick="themInput<?php echo $taikhoangames['id_taikhoangame'] ?>()">Thêm một ảnh</a>
												</div>
												<input type="hidden" name="soanh" id="soanh<?php echo $taikhoangames['id_taikhoangame'] ?>" value="0">
												<input type="hidden" name="anhbixoa" id="anhbixoa<?php echo $taikhoangames['id_taikhoangame'] ?>" value="">
												<input type="hidden" name="hinhanhbandau" value="<?php echo $taikhoangames['hinhanhchitiet'] ?>">

												<input type="hidden" name="thumbnal_cu" value="<?php echo $taikhoangames['img'] ?>">

												<div class="div_input">
													<span>Trạng thái</span>
													<select name="tinhtrang" id="">
														<option value="Bật" <?php if ($taikhoangames['trangthai'] == "Bật") echo "selected" ?> >Bật</option>
														<option value="Tắt" <?php if ($taikhoangames['trangthai'] == "Tắt") echo "selected" ?> >Tắt</option>
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

						</th>
					</tr>
					<script>
						let inputCounter<?php echo $taikhoangames['id_taikhoangame'] ?> = 0;
						let deletedImages<?php echo $taikhoangames['id_taikhoangame'] ?> = [];

						function themInput<?php echo $taikhoangames['id_taikhoangame'] ?>(initialImage = null, anhbandau = true) {
							inputCounter<?php echo $taikhoangames['id_taikhoangame'] ?>++;

							const container = document.createElement("div");
							container.classList.add("input-container<?php echo $taikhoangames['id_taikhoangame'] ?>");
							container.style.display = "grid";
							container.style.gridAutoColumns = "1fr";
							container.style.gridAutoRows = "1fr";
							container.style.gridTemplateColumns = "284.8px 110px";
							container.style.gridTemplateRows = "auto auto";
							container.style.gap = "0px 0px";
							container.style.gridTemplateAreas = `
                            ". ."
                            ". ."
                            `;

							const input = document.createElement("input");
							input.type = "file";
							input.accept = "image/*";
							input.className = "input_upload";
							input.name = "anh" + inputCounter<?php echo $taikhoangames['id_taikhoangame'] ?>;
							if (anhbandau) {
								input.required = true;
							} else {
								input.required = false;
							}

							const btnXoa = document.createElement("button");
							btnXoa.textContent = "Xóa ảnh";
							btnXoa.style.margin = "10px";
							btnXoa.style.padding = "0px 10px";

							btnXoa.addEventListener("click", function() {
								container.remove();
								capNhatTenInput<?php echo $taikhoangames['id_taikhoangame'] ?>();
								capNhatHinhAnhPreview<?php echo $taikhoangames['id_taikhoangame'] ?>();

								// Add the deleted image to the array
								const deletedImage = input.getAttribute("data-initial-image");
								if (deletedImage) {
									deletedImages<?php echo $taikhoangames['id_taikhoangame'] ?>.push(deletedImage);
									updateDeletedImagesInput<?php echo $taikhoangames['id_taikhoangame'] ?>();
								}
							});

							const imagePreview = document.createElement("img");
							imagePreview.className = "image-preview<?php echo $taikhoangames['id_taikhoangame']; ?>" + inputCounter<?php echo $taikhoangames['id_taikhoangame'] ?>;
							imagePreview.style.maxWidth = "100px";
							imagePreview.style.maxHeight = "100px";
							imagePreview.style.marginBottom = "10px";

							container.appendChild(input);
							container.appendChild(btnXoa);
							container.appendChild(imagePreview);

							document.getElementById("inputContainer<?php echo $taikhoangames['id_taikhoangame'] ?>").appendChild(container);

							input.addEventListener("change", function(event) {
								hienThiAnhPreview<?php echo $taikhoangames['id_taikhoangame'] ?>(event, imagePreview);
							});

							// If there's an initial image, display it
							if (initialImage) {
								input.setAttribute("data-initial-image", initialImage);
								hienThiAnhTuLink<?php echo $taikhoangames['id_taikhoangame'] ?>(initialImage, imagePreview);
							}

							capNhatTenInput<?php echo $taikhoangames['id_taikhoangame'] ?>();
							capNhatHinhAnhPreview<?php echo $taikhoangames['id_taikhoangame'] ?>();
						}

						function capNhatTenInput<?php echo $taikhoangames['id_taikhoangame'] ?>() {
							const containers = document.querySelectorAll(".input-container<?php echo $taikhoangames['id_taikhoangame'] ?>");
							const soanhInput = document.getElementById("soanh<?php echo $taikhoangames['id_taikhoangame'] ?>");
							const h4_hinhanhsanpham = document.getElementById("h4_hinhanhsanpham<?php echo $taikhoangames['id_taikhoangame'] ?>");

							h4_hinhanhsanpham.textContent = "Hình ảnh sản phẩm: " + containers.length;
							soanhInput.value = containers.length;

							containers.forEach(function(container, index) {
								const input = container.querySelector("input");
								input.name = "anh" + (index + 1);
							});
						}

						function hienThiAnhPreview<?php echo $taikhoangames['id_taikhoangame'] ?>(event, imagePreview) {
							const input = event.target;
							const file = input.files[0];

							if (file) {
								const reader = new FileReader();

								reader.onload = function(e) {
									imagePreview.src = e.target.result;
								};

								reader.readAsDataURL(file);
							} else {
								// If no new file, check for an initial image
								const initialImage = input.getAttribute("data-initial-image");

								if (initialImage) {
									// If there is, display the initial image
									imagePreview.src = initialImage;
								} else {
									// Otherwise, clear the image preview
									imagePreview.src = "";
								}
							}
						}

						function hienThiAnhTuLink<?php echo $taikhoangames['id_taikhoangame'] ?>(link, imagePreview) {
							const image = new Image();
							image.onload = function() {
								imagePreview.src = link;
							};
							image.src = link;
						}

						function capNhatHinhAnhPreview<?php echo $taikhoangames['id_taikhoangame'] ?>() {
							const imagePreviewContainer = document.getElementById("imagePreviewContainer<?php echo $taikhoangames['id_taikhoangame'] ?>");
							imagePreviewContainer.innerHTML = "";

							const containers = document.querySelectorAll(".input-container<?php echo $taikhoangames['id_taikhoangame'] ?>");

							containers.forEach(function(container, index) {
								const input = container.querySelector("input");
								const file = input.files[0];

								if (file) {
									const imagePreview = document.createElement("img");
									imagePreview.className = "image-preview<?php echo $taikhoangames['id_taikhoangame'] ?>";
									imagePreview.style.maxWidth = "100px";
									imagePreview.style.maxHeight = "100px";

									const imagePreviewContainerItem = document.createElement("div");
									imagePreviewContainerItem.className = "image-preview-container<?php echo $taikhoangames['id_taikhoangame'] ?>";
									imagePreviewContainerItem.appendChild(imagePreview);

									// Add index to the id to ensure uniqueness
									imagePreviewContainerItem.id = "imagePreviewContainerItem_<?php echo $taikhoangames['id_taikhoangame']; ?>_" + index;

									imagePreviewContainer.appendChild(imagePreviewContainerItem);

									const reader = new FileReader();
									reader.onload = function(e) {
										imagePreview.src = e.target.result;
									};
									reader.readAsDataURL(file);
								}
							});
						}

						// Array of initial images
						<?php
						$mang = explode(",", $taikhoangames['hinhanhchitiet']);
						$manghinhanh = "";
						foreach ($mang as $mangs) {
							$manghinhanh = "$manghinhanh,'$mangs'";
						}

						?>
						const arrayOfInitialImages<?php echo $taikhoangames['id_taikhoangame'] ?> = [
							<?php echo $manghinhanh ?>
						];

						// Add input for each initial image
						arrayOfInitialImages<?php echo $taikhoangames['id_taikhoangame'] ?>.forEach(function(initialImage<?php echo $taikhoangames['id_taikhoangame']; ?>) {
							themInput<?php echo $taikhoangames['id_taikhoangame'] ?>(initialImage<?php echo $taikhoangames['id_taikhoangame']; ?>, false);
						});

						// Function to update the deleted images input
						function updateDeletedImagesInput<?php echo $taikhoangames['id_taikhoangame'] ?>() {
							const deletedImagesInput = document.getElementById("anhbixoa<?php echo $taikhoangames['id_taikhoangame'] ?>");
							deletedImagesInput.value = deletedImages<?php echo $taikhoangames['id_taikhoangame'] ?>.join(",");
						}
					</script>
				<?php endforeach; ?>







			</table>
			<div style="width: 100%;display: flex;justify-content: center;">


				<?php

				$page =  (int)($_GET['page'] ?? "1");
				$count = 1;
				$count_2 = 1;
				$trangthai = $_REQUEST['trangthai'] ?? null;
				$danhmucgame = $_REQUEST['danhmucgame'] ?? null;

				if ($trangthai != null) {
					$trangthai = "&trangthai=" . $trangthai;
				}
				if ($danhmucgame != null) {
					$danhmucgame = "&danhmucgame=" . $danhmucgame;
				}

				?>
				<div class="pagination">
					<a class="" href="<?php if ($page > 1) echo "./index.php?controller=admin&action=quanlytaikhoan$trangthai$danhmucgame&page=" . $page - 1 ?>">&laquo;</a>
					<a class="<?php if ($page == 1) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlytaikhoan$trangthai$danhmucgame&page=1" ?>">1</a>
					<?php if ($maxpage > 6) : ?>
						<?php if ($page >= 1 && $page < 5) : ?>

							<?php for ($i = 2; $i < $page + 6; $i++) : ?>
								<?php if ($count_2 == 5) : ?>
									<a class="">. . .</a>
								<?php else : ?>
									<a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlytaikhoan$trangthai$danhmucgame&page=$i" ?>"><?php echo $i ?></a>
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
									<a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlytaikhoan$trangthai$danhmucgame&page=$i" ?>"><?php echo $i ?></a>
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
									<a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlytaikhoan$trangthai$danhmucgame&page=$i" ?>"><?php echo $i ?></a>
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

							<a class="<?php if ($i == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlytaikhoan$trangthai$danhmucgame&page=$i" ?>"><?php echo $i ?></a>

						<?php endfor; ?>
					<?php endif; ?>
					<?php if ($maxpage != 0 && $maxpage != 1) : ?>
						<a class="<?php if ($maxpage == $page) echo "active" ?>" href="<?php echo "./index.php?controller=admin&action=quanlytaikhoan$trangthai$danhmucgame&page=$maxpage" ?>"><?php echo $maxpage ?></a>
					<?php endif; ?>
					<a class="" href="<?php if ($page < $maxpage) echo "./index.php?controller=admin&action=quanlytaikhoan$trangthai$danhmucgame&page=" . $page + 1. ?>">&raquo;</a>
				</div>
			</div>

		</main>
	</div>


</body>


</html>