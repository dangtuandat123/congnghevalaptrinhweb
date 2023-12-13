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
	<style>
		.hide {
			display: none;
		}
	</style>
</head>

<body onload="graph_doanhthu()">


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
					<a href="./index.php?controller=admin&action=thongke" class="active"><span class="las la-plus"></span>
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
						<h1><?php
							$sotien = (int)$tongdoanhthu;
							$sotien = number_format($sotien, 0, '.', ',');
							echo $sotien; ?>
							VNĐ</h1>
						<span>Tổng doanh thu</span>
					</div>

					<div>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1><?php echo $tongdonhang ?></h1>
						<span>Tổng đơn hàng</span>
					</div>

					<div>
					</div>
				</div>


			</div>
			<div style="text-align:center;background-color:  white; padding: 10px; width: 177px; border-radius: 10px;margin-top: 10px; margin-bottom: -20px;">
				<label style="font-size: 19px;" for="selectOption_doanhthu">DOANH THU</label>
				<select style="padding: 3px;" id="selectOption_doanhthu" onchange="toggleDiv_doanhthu()">
					<option value="div1_doanhthu">Thống kê theo tháng</option>
					<option value="div2_doanhthu">Thống kê theo năm</option>
				</select>
			</div>



			<div id="div1_doanhthu" class="hide">
				<div class="recent-grid">
					<div class="graph-card">
						<div style="font-size: 18px; text-transform: uppercase; font-weight: 600;" class="section-head" id="output"></div>

						<div class="graph-content">
							<div class="graph-head">
								<div class="icon">
									<span class="las la-eye text-main"></span>
								</div>
								<div class="graph-select">
									<input type="month" name="doanhthu" id="doanhthu" onchange="loc_doanhthu()">
								</div>
							</div>

							<div class="graph-board">
								<canvas id="bieudo_doanhthu">
								</canvas>

							</div>
						</div>

					</div>
				</div>

				<script>
					document.addEventListener('DOMContentLoaded', function() {
						const doanhthu_input = document.getElementById("doanhthu");
						const outputDiv = document.getElementById("output");
						const ctx = document.querySelector("#bieudo_doanhthu");
						let revChart; 
						function drawChart(labels, data) {
							if (revChart) {
								revChart.destroy();
							}

							revChart = new Chart(ctx, {
								type: "line",
								data: {
									labels: labels,
									datasets: [{
										label: "Doanh thu",
										borderColor: "#DD2F6E",
										borderWidth: "3",
										backgroundColor: "rgba(235, 247, 245, 0.5)",
										data: data.map(value => parseFloat(value.replace(',', '')))
									}]
								},
								options: {
									responsive: true,
									tooltips: {
										intersect: false,
										mode: "index",
										callbacks: {
											label: function(tooltipItem, data) {
												let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
												return 'Doanh thu: ' + value.toLocaleString() + " VNĐ";
											}
										}
									},
									scales: {
										y: {
											ticks: {
												callback: function(value, index, values) {
													return value.toLocaleString();
												}
											}
										}
									}
								}
							});
						}

						function generateDatesInMonth(year, month) {
							let daysInMonth = new Date(year, month, 0).getDate();
							let datesArray = Array.from({
								length: daysInMonth
							}, (_, i) => `${year}-${(month < 10 ? "0" : "") + month}-${(i + 1 < 10 ? "0" : "") + (i + 1)}`);
							return datesArray;
						}

						function laydulieu(ngaythang, callback) {
							var xhr = new XMLHttpRequest();
							xhr.open('POST', './index.php', true);
							xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xhr.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									var dulieu = xoaPhanDoctype(this.responseText);
									callback(dulieu);
								}
							};
							var data = 'controller=admin&action=xulythongke&thaotac=thongkedoanhthu&date=' + ngaythang;
							xhr.send(data);
						}

						function xoaPhanDoctype(html) {
							var index = html.indexOf('<!DOCTYPE html>');
							if (index !== -1) {
								return html.substring(0, index);
							}
							return html;
						}

						doanhthu_input.addEventListener('change', function() {
							let selectedMonth = doanhthu_input.value;
							let [years, months] = selectedMonth.split("-");
							let datesInMonth = generateDatesInMonth(parseInt(years), parseInt(months));
							let datesString = datesInMonth.join(', ');

							laydulieu(datesString, function(dulieu) {
								var mang = dulieu.split(',');

								let tong = mang.reduce((accumulator, currentValue) => accumulator + parseInt(currentValue), 0);
								tong = tong.toLocaleString();

								outputDiv.innerHTML = `Doanh thu ${selectedMonth} : ${tong} VNĐ`;
								let [year, month] = selectedMonth.split("-");
								let daysInMonth = new Date(year, month, 0).getDate();
								let labels = Array.from({
									length: daysInMonth
								}, (_, i) => `Ngày ${i + 1}`);
								drawChart(labels, mang);
							});
						});

						let today = new Date();
						let currentMonth = today.getMonth() + 1;
						let currentYear = today.getFullYear();
						let currentMonthString = currentYear + "-" + (currentMonth < 10 ? "0" : "") + currentMonth;
						doanhthu_input.value = currentMonthString;

						doanhthu_input.dispatchEvent(new Event('change'));
					});
				</script>
			</div>

			<div id="div2_doanhthu" class="hide">

				<div class="recent-grid">
					<div class="graph-card">
						<div class="section-head" style="font-size: 18px; text-transform: uppercase; font-weight: 600;"  id="output_doanhthutheonam"></div>
						<div class="graph-content">
							<div class="graph-head">
								<div class="icon">
									<span class="las la-eye text-main"></span>
								</div>
								<div class="graph-select">

									<label for="doanhthutheonam">Chọn năm:</label>
									<select id="doanhthutheonam" name="selectYear">
										<?php
										$currentYear = date("Y");

										for ($year = 2000; $year <= $currentYear; $year++) {
											echo "<option style='color: #ffffff;' value='$year'>$year</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="graph-board">
								<canvas id="bieudo_doanhthutheonam"></canvas>
							</div>
						</div>
					</div>
				</div>

				<script>
					document.addEventListener('DOMContentLoaded', function() {
						const doanhthutheonam_input = document.getElementById("doanhthutheonam");
						const outputDiv_doanhthutheonam = document.getElementById("output_doanhthutheonam");
						const ctx_doanhthutheonam = document.querySelector("#bieudo_doanhthutheonam");
						let doanhthutheonamChart;

						function drawdoanhthutheonamChart(labels, data) {
							if (doanhthutheonamChart) {
								doanhthutheonamChart.destroy();
							}

							doanhthutheonamChart = new Chart(ctx_doanhthutheonam, {
								type: "bar",
								data: {
									labels: labels,
									datasets: [{
										label: "Doanh thu",
										borderColor: "#DD2F6E",
										borderWidth: "3",
										backgroundColor: "#DD2F6E",
										data: data.map(value => parseFloat(value.replace(',', ''))) 
									}]
								},
								options: {
									responsive: true,
									tooltips: {
										intersect: false,
										mode: "index",
										callbacks: {
											label: function(tooltipItem, data) {
												let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
												return 'Doanh thu: ' + value.toLocaleString() + " VNĐ";
											}
										}
									},
									scales: {
										y: {
											ticks: {
												callback: function(value, index, values) {
													return value.toLocaleString();
												}
											}
										}
									}
								}
							});
						}

						function generateDatesInMonthdoanhthutheonam(year) {
							let datesString = "";
							for (let month = 1; month <= 12; month++) {
								let dateString = `${year}-${month}`;
								datesString += dateString + ",";
							}
							datesString = datesString.replace(/,$/, "");
							return datesString;
						}

						function laydulieudoanhthutheonam(ngaythang, callback) {
							var xhr = new XMLHttpRequest();
							xhr.open('POST', './index.php', true);
							xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xhr.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									var dulieu = xoaPhanDoctype(this.responseText);
									callback(dulieu);
								}
							};
							var data = 'controller=admin&action=xulythongke&thaotac=thongkedoanhthutheonam&date=' + ngaythang;
							xhr.send(data);
						}

						function xoaPhanDoctype(html) {
							var index = html.indexOf('<!DOCTYPE html>');
							if (index !== -1) {
								return html.substring(0, index);
							}
							return html;
						}

						doanhthutheonam_input.addEventListener('change', function() {
							let selectedMonth = doanhthutheonam_input.value;
							let datesInMonth = generateDatesInMonthdoanhthutheonam(selectedMonth);
							console.log(datesInMonth)

							laydulieudoanhthutheonam(datesInMonth, function(dulieu) {
								console.log(dulieu)
								var mang = dulieu.split(',');
								let tong = mang.reduce((accumulator, currentValue) => accumulator + parseInt(currentValue), 0);
								tong = tong.toLocaleString();

								outputDiv_doanhthutheonam.innerHTML = `Doanh thu ${selectedMonth} : ${tong} VNĐ`;

								drawdoanhthutheonamChart(["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"], mang);
							});
						});

						let today = new Date();
						let currentMonth = today.getMonth() + 1;
						let currentYear = today.getFullYear();
						let currentMonthString = currentYear;
						doanhthutheonam_input.value = currentMonthString;
						doanhthutheonam_input.dispatchEvent(new Event('change'));
					});
				</script>
			</div>

			<script>
				document.addEventListener('DOMContentLoaded', function() {
					var div1_doanhthu = document.getElementById("div1_doanhthu");
					var div2_doanhthu = document.getElementById("div2_doanhthu");
					div1_doanhthu.classList.remove("hide");
					div2_doanhthu.classList.add("hide");
				});

				function toggleDiv_doanhthu() {
					var select = document.getElementById("selectOption_doanhthu");
					var div1 = document.getElementById("div1_doanhthu");
					var div2 = document.getElementById("div2_doanhthu");

					if (select.value === "div1_doanhthu") {
						div1.classList.remove("hide");
						div2.classList.add("hide");
					} else if (select.value === "div2_doanhthu") {
						div1.classList.add("hide");
						div2.classList.remove("hide");
					}
				}
			</script>


			<!-- thongkedonhang--------------------------------------------------------------------------------------------------- -->

			<div style="text-align:center;background-color: white; padding: 10px; width: 177px; border-radius: 10px;margin-top: 10px; margin-bottom: -20px;">
				<label style="font-size: 19px;" for="selectOption_donhang">ĐƠN HÀNG</label>
				<select style="padding: 3px;" id="selectOption_donhang" onchange="toggleDiv_donhang()">
					<option value="div1_donhang">Thống kê theo tháng</option>
					<option value="div2_donhang">Thống kê theo năm</option>
				</select>
			</div>



			<div id="div1_donhang" class="hide">
				<div class="recent-grid">
					<div class="graph-card">
						<div class="section-head" style="font-size: 18px; text-transform: uppercase; font-weight: 600;"  id="output_donhang"></div>

						<div class="graph-content">
							<div class="graph-head">
								<div class="icon">
									<span class="las la-eye text-main"></span>
								</div>
								<div class="graph-select">
									<input type="month" name="donhang" id="donhang" onchange="loc_donhang()">
								</div>
							</div>

							<div class="graph-board">
								<canvas id="bieudo_donhang">
								</canvas>

							</div>
						</div>

					</div>
				</div>

				<script>
					document.addEventListener('DOMContentLoaded', function() {
						const donhang_input = document.getElementById("donhang");
						const output_donhang = document.getElementById("output_donhang");
						const ctx = document.querySelector("#bieudo_donhang");
						let revChart; 

						function drawChart(labels, data) {
							if (revChart) {
								revChart.destroy();
							}

							revChart = new Chart(ctx, {
								type: "line",
								data: {
									labels: labels,
									datasets: [{
										label: "Đơn hàng",
										borderColor: "#34abeb",
										borderWidth: "3",
										backgroundColor: "rgba(235, 247, 245, 0.5)",
										data: data.map(value => value) 
									}]
								},
								options: {
									responsive: true,
									tooltips: {
										intersect: false,
										mode: "index",
										callbacks: {
											label: function(tooltipItem, data) {
												let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
												return value.toLocaleString() + " Đơn hàng";
											}
										}
									},
									scales: {
										y: {
											ticks: {
												callback: function(value, index, values) {
													return value.toLocaleString();
												}
											}
										}
									}
								}
							});
						}

						function generateDatesInMonth(year, month) {
							let daysInMonth = new Date(year, month, 0).getDate();
							let datesArray = Array.from({
								length: daysInMonth
							}, (_, i) => `${year}-${(month < 10 ? "0" : "") + month}-${(i + 1 < 10 ? "0" : "") + (i + 1)}`);
							return datesArray;
						}

						function laydulieu(ngaythang, callback) {
							var xhr = new XMLHttpRequest();
							xhr.open('POST', './index.php', true);
							xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xhr.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									var dulieu = xoaPhanDoctype(this.responseText);
									callback(dulieu);
								}
							};
							var data = 'controller=admin&action=xulythongke&thaotac=thongkedonhang&date=' + ngaythang;
							xhr.send(data);
						}

						function xoaPhanDoctype(html) {
							var index = html.indexOf('<!DOCTYPE html>');
							if (index !== -1) {
								return html.substring(0, index);
							}
							return html;
						}

						donhang_input.addEventListener('change', function() {
							let selectedMonth = donhang_input.value;
							let [years, months] = selectedMonth.split("-");
							let datesInMonth = generateDatesInMonth(parseInt(years), parseInt(months));
							let datesString = datesInMonth.join(', ');

							laydulieu(datesString, function(dulieu) {
								var mang = dulieu.split(',');

								let tong = mang.reduce((accumulator, currentValue) => accumulator + parseInt(currentValue), 0);
								tong = tong.toLocaleString();
								output_donhang.innerHTML = `Đơn hàng ${selectedMonth}: ${tong}`;

								let [year, month] = selectedMonth.split("-");
								let daysInMonth = new Date(year, month, 0).getDate();
								let labels = Array.from({
									length: daysInMonth
								}, (_, i) => `Ngày ${i + 1}`);
								drawChart(labels, mang);
							});
						});
						let today = new Date();
						let currentMonth = today.getMonth() + 1;
						let currentYear = today.getFullYear();
						let currentMonthString = currentYear + "-" + (currentMonth < 10 ? "0" : "") + currentMonth;
						donhang_input.value = currentMonthString;

						donhang_input.dispatchEvent(new Event('change'));
					});
				</script>
			</div>

			<div id="div2_donhang" class="hide">

				<div class="recent-grid">
					<div class="graph-card">
						<div class="section-head" style="font-size: 18px; text-transform: uppercase; font-weight: 600;"  id="output_donhangtheonam"></div>
						<div class="graph-content">
							<div class="graph-head">
								<div class="icon">
									<span class="las la-eye text-main"></span>
								</div>
								<div class="graph-select">

									<label for="donhangtheonam">Chọn năm:</label>
									<select id="donhangtheonam" name="selectYear">
										<?php
										$currentYear = date("Y");

										for ($year = 2000; $year <= $currentYear; $year++) {
											echo "<option style='color: #ffffff;' value='$year'>$year</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="graph-board">
								<canvas id="bieudo_donhangtheonam"></canvas>
							</div>
						</div>
					</div>
				</div>

				<script>
					document.addEventListener('DOMContentLoaded', function() {
						const donhangtheonam_input = document.getElementById("donhangtheonam");
						const outputDiv_donhangtheonam = document.getElementById("output_donhangtheonam");
						const ctx_donhangtheonam = document.querySelector("#bieudo_donhangtheonam");
						let donhangtheonamChart;

						function drawdonhangtheonamChart(labels, data) {
							if (donhangtheonamChart) {
								donhangtheonamChart.destroy();
							}

							donhangtheonamChart = new Chart(ctx_donhangtheonam, {
								type: "bar",
								data: {
									labels: labels,
									datasets: [{
										label: "Đơn hàng",
										borderColor: "#34abeb",
										borderWidth: "3",
										backgroundColor: "#34abeb",
										data: data.map(value => value) 
									}]
								},
								options: {
									responsive: true,
									tooltips: {
										intersect: false,
										mode: "index",
										callbacks: {
											label: function(tooltipItem, data) {
												let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
												return value.toLocaleString() + " Đơn hàng";
											}
										}
									},
									scales: {
										y: {
											ticks: {
												callback: function(value, index, values) {
													return value.toLocaleString();
												}
											}
										}
									}
								}
							});
						}

						function generateDatesInMonthdonhangtheonam(year) {
							let datesString = "";
							for (let month = 1; month <= 12; month++) {
								let dateString = `${year}-${month}`;
								datesString += dateString + ",";
							}
							datesString = datesString.replace(/,$/, "");
							return datesString;
						}

						function laydulieudonhangtheonam(ngaythang, callback) {
							var xhr = new XMLHttpRequest();
							xhr.open('POST', './index.php', true);
							xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xhr.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									var dulieu = xoaPhanDoctype(this.responseText);
									callback(dulieu);
								}
							};
							var data = 'controller=admin&action=xulythongke&thaotac=thongkedonhangtheonam&date=' + ngaythang;
							xhr.send(data);
						}

						function xoaPhanDoctype(html) {
							var index = html.indexOf('<!DOCTYPE html>');
							if (index !== -1) {
								return html.substring(0, index);
							}
							return html;
						}

						donhangtheonam_input.addEventListener('change', function() {
							let selectedMonth = donhangtheonam_input.value;
							let datesInMonth = generateDatesInMonthdonhangtheonam(selectedMonth);
							console.log(datesInMonth)

							laydulieudonhangtheonam(datesInMonth, function(dulieu) {
								console.log(dulieu)
								var mang = dulieu.split(',');
								let tong = mang.reduce((accumulator, currentValue) => accumulator + parseInt(currentValue), 0);
								tong = tong.toLocaleString();
								outputDiv_donhangtheonam.innerHTML= `Đơn hàng ${selectedMonth}: ${tong}`;

								drawdonhangtheonamChart(["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"], mang);
							});
						});

						let today = new Date();
						let currentMonth = today.getMonth() + 1;
						let currentYear = today.getFullYear();
						let currentMonthString = currentYear;
						donhangtheonam_input.value = currentMonthString;
						donhangtheonam_input.dispatchEvent(new Event('change'));
					});
				</script>
			</div>

			<script>
				document.addEventListener('DOMContentLoaded', function() {
					var div1_donhang = document.getElementById("div1_donhang");
					var div2_donhang = document.getElementById("div2_donhang");
					div1_donhang.classList.remove("hide");
					div2_donhang.classList.add("hide");
				});

				function toggleDiv_donhang() {
					var select = document.getElementById("selectOption_donhang");
					var div1 = document.getElementById("div1_donhang");
					var div2 = document.getElementById("div2_donhang");

					if (select.value === "div1_donhang") {
						div1.classList.remove("hide");
						div2.classList.add("hide");
					} else if (select.value === "div2_donhang") {
						div1.classList.add("hide");
						div2.classList.remove("hide");
					}
				}
			</script>





		</main>
	</div>


</body>


</html>