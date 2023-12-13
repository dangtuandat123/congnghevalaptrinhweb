<?php

class AdminController extends BaseController
{
    private $DanhmucgameModel;
    private $TaikhoangameModel;
    private $NguoidungModel;
    private $NaptienModel;
    private $DonhangModel;

    private $AdminModel;
    private $HoadonModel;


    public function __construct()
    {
        // load file model
        $this->loadModel('DanhmucgameModel');
        $this->DanhmucgameModel = new DanhmucgameModel;

        $this->loadModel('TaikhoangameModel');
        $this->TaikhoangameModel = new TaikhoangameModel;

        $this->loadModel('NguoidungModel');
        $this->NguoidungModel = new NguoidungModel;


        $this->loadModel('DonhangModel');
        $this->DonhangModel = new DonhangModel;
        $this->loadModel('AdminModel');
        $this->AdminModel = new AdminModel;
        $this->loadModel('HoadonModel');
        $this->HoadonModel = new HoadonModel;
    }
    private function xoaHinhAnhTheoDuongDan($duongDan)
    {
        if (file_exists($duongDan)) {
            unlink($duongDan);
            return true; // Xóa thành công
        } else {
            return false; // Không tìm thấy đường dẫn hoặc không xóa được
        }
    }
    private function uploadImageWithCustomName($fileInputName, $targetDirectory, $customFileName)
    {
        // Kiểm tra xem có lỗi nào xảy ra trong quá trình tải lên
        if ($_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
            return "loi"; // Thay đổi thông báo lỗi tại đây nếu bạn muốn
        }

        // Kiểm tra định dạng tệp hợp lệ
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        $fileExtension = pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return "loi"; // Thay đổi thông báo lỗi tại đây nếu bạn muốn
        }

        // Tạo đường dẫn đầy đủ cho tệp đích
        $targetFile = $targetDirectory . $customFileName . '.' . $fileExtension;

        // Kiểm tra và tạo thư mục nếu thư mục không tồn tại
        if (!file_exists($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) {
                return "loi"; // Thay đổi thông báo lỗi tại đây nếu bạn muốn
            }
        }

        // Kiểm tra xem tệp đã tồn tại chưa
        if (file_exists($targetFile)) {
            return "loi"; // Thay đổi thông báo lỗi tại đây nếu bạn muốn
        }

        // Thực hiện tải lên
        if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFile)) {
            return $targetFile; // Trả về đường dẫn của tệp tải lên thành công
        } else {
            return "loi"; // Thay đổi thông báo lỗi tại đây nếu bạn muốn
        }
    }

    function deleteImageWithoutExtension($fileName, $directory)
    {
        $allowedExtensions = ["jpg", "jpeg", "png", "gif", "bmp", "tiff"]; // Danh sách phần mở rộng có thể có

        $found = false;

        foreach ($allowedExtensions as $extension) {
            $filePath = $directory . $fileName . '.' . $extension;
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    $found = true;
                    break;
                }
            }
        }

        if ($found) {
            return "Xóa tệp thành công.";
        } else {
            return "Không thể xóa tệp.";
        }
    }
    private function doiTenFile($duongDan, $tenMoi)
    {
        // Lấy đường dẫn và tên tệp
        $duongDanTep = pathinfo($duongDan);

        // Tạo đường dẫn mới với tên tệp mới
        $duongDanMoi = $duongDanTep['dirname'] . '/' . $tenMoi . '.' . $duongDanTep['extension'];

        // Thực hiện việc đổi tên tệp
        if (rename($duongDan, $duongDanMoi)) {
            return $duongDanMoi; // Trả về đường dẫn mới
        } else {
            return false; // Đổi tên không thành công
        }
    }
    private function layDanhSachDuongDan($thuMuc)
    {
        $duongDanTep = [];

        // Lấy danh sách tên tệp trong thư mục
        $danhSachTep = scandir($thuMuc);

        // Lọc ra chỉ các tệp tin, loại bỏ các thư mục
        foreach ($danhSachTep as $tep) {
            $duongDanTeptin = $thuMuc . '/' . $tep;

            // Kiểm tra xem có phải là tệp tin không
            if (is_file($duongDanTeptin)) {
                $duongDanTep[] = $duongDanTeptin;
            }
        }

        return $duongDanTep;
    }





    public function index()
    {
        if ($_SESSION['capbac'] == "admin") {
            header('Location: ./index.php?controller=admin&action=bangdieukhien');
        } else {
            header('Location: ./index.php?controller=trangchu');
        }
    }
    public function bangdieukhien()

    {
        if ($_SESSION['capbac'] == "admin") {
            $nguoidangkimoi = $this->NguoidungModel->nguoidangkimoi();
            $donHangHomNay = $this->DonhangModel->donHangHomNay();
            $doanhthuhomnay = $this->HoadonModel->doanhThuHomNay();


            $donhangganday = $this->DonhangModel->donHangGanDay();
            // print_r($donhangganday);
            // die();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $so_ngay_trong_thang = date('t');
            $first_day_of_month = date("Y-m-01");
            $ArrayDoanhThu = [];
            for ($i = 0; $i < (int)$so_ngay_trong_thang; $i++) {
                // Tạo timestamp cho ngày hiện tại
                $current_day_timestamp = strtotime($first_day_of_month . " +" . $i . " days");
                $current_day = date("Y-m-d", $current_day_timestamp);
                $doanhthutheongay = $this->AdminModel->doanhThuThangNay($current_day);
                if ($doanhthutheongay[0]['SUM(giatien)'] == "") {
                    array_push($ArrayDoanhThu, "0");
                } else {
                    // $sotien = (int)$doanhthutheongay[0]['SUM(giatien)'] ;
                    // $sotien = number_format($sotien, 0, '.', ',');
                    array_push($ArrayDoanhThu, $doanhthutheongay[0]['SUM(giatien)']);
                }
            }
            $doanhthuthangnay = "";

            foreach ($ArrayDoanhThu as $ArrayDoanhThus) {
                $doanhthuthangnay = $doanhthuthangnay . $ArrayDoanhThus . ",";
            }

            $doanhthuthangnay = rtrim($doanhthuthangnay, ',');
            return $this->view('admin.bangdieukhien', [
                'nguoidungdangkimoi' => count($nguoidangkimoi),
                'donhanghomnay' => count($donHangHomNay),
                'doanhthuhomnay' =>  $doanhthuhomnay[0]['SUM(giatien)'],
                'donhangganday' => $donhangganday,
                'doanhthuthangnay' => $doanhthuthangnay,

            ]);
        } else {
            header('Location: ./index.php?controller=trangchu');
        }
    }
    public function quanlydanhmuc()

    {
        if ($_SESSION['capbac'] == "admin") {


            $thaotac = $_GET['thaotac'] ?? "";
            if ($thaotac == '') {
                $danhmucgame = $this->DanhmucgameModel->getAll();
                $danhmucgame_2 = $this->DanhmucgameModel->hienThiDanhMucGame();

                return $this->view('admin.quanlydanhmuc', [
                    'danhmucgame' => $danhmucgame,
                    'tongsodanhmuc' => count($danhmucgame),
                    'tongsodanhmuchoatdong' => count($danhmucgame_2),

                ]);
            } else if ($thaotac == 'timkiem') {
                $tukhoa = $_GET['tukhoa'] ?? null;
                $trangthai = $_GET['trangthai'] ?? null;
                if ($trangthai != null) {
                    $trangthai = "AND trangthai = '$trangthai'";
                }
                $danhmucgame_1 = $this->DanhmucgameModel->getAll();
                $danhmucgame_2 = $this->DanhmucgameModel->hienThiDanhMucGame();
                $danhmucgame = $this->DanhmucgameModel->quanLyDanhMucLoc($tukhoa, $trangthai);
                return $this->view('admin.quanlydanhmuc', [
                    'danhmucgame' => $danhmucgame,
                    'tongsodanhmuc' => count($danhmucgame_1),
                    'tongsodanhmuchoatdong' => count($danhmucgame_2),
                ]);
            } elseif ($thaotac == 'themdanhmuc') {

                $tengame = $_POST['tengame'];
                $trangthai = $_POST['trangthai'];
                $maxId = $this->AdminModel->selectCustoms("SELECT MAX(id_danhmucgame) FROM danhmucgame");
                $maxId = (int)$maxId[0]['MAX(id_danhmucgame)'];
                $maxId = $maxId + 1;
                $duongdan_background = $this->uploadImageWithCustomName("background", "./views/img/danhmucgame_background/", "$maxId");
                $duongdan_thumbnal = $this->uploadImageWithCustomName("thumbnal", "./views/img/danhmucgame_thumbnal/", "$maxId");
                if ($duongdan_background != "loi" && $duongdan_thumbnal != "loi") {
                    $kq = $this->DanhmucgameModel->themDanhMuc($maxId, $tengame, $duongdan_thumbnal, $duongdan_background, $trangthai);
                    echo "<script>
                    alert('Thêm danh mục thành công!');
                    window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                   </script>";
                } else {
                    echo "<script>
                    alert('Thêm danh mục không thành công!');
                    window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                   </script>";
                }
            } elseif ($thaotac == "capnhapdanhmuc") {

                $tengame = $_POST['tengame'];
                $trangthai = $_POST['trangthai'];
                $id_danhmucgame = $_POST['id_danhmucgame'];
                $duongdan_background = $_POST['duongdan_background'];
                $duongdan_thumbnal = $_POST['duongdan_thumbnal'];

                if ($_FILES['thumbnal']['name'] == null && $_FILES['background']['name'] == null) {
                    $kq = $this->DanhmucgameModel->updateDanhMuc($tengame, $duongdan_thumbnal, $duongdan_background, $trangthai, $id_danhmucgame);
                    echo "<script>
                            alert('Cập nhập danh mục thành công!');
                            window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                           </script>";
                } elseif ($_FILES['thumbnal']['name'] != "" && $_FILES['background']['name'] != "") {

                    $this->deleteImageWithoutExtension($id_danhmucgame, "./views/img/danhmucgame_background/");
                    $this->deleteImageWithoutExtension($id_danhmucgame, "./views/img/danhmucgame_thumbnal/");
                    $duongdan_background = $this->uploadImageWithCustomName("background", "./views/img/danhmucgame_background/", "$id_danhmucgame");
                    $duongdan_thumbnal = $this->uploadImageWithCustomName("thumbnal", "./views/img/danhmucgame_thumbnal/", "$id_danhmucgame");
                    if ($duongdan_background != "loi" && $duongdan_thumbnal != "loi") {
                        $kq = $this->DanhmucgameModel->updateDanhMuc($tengame, $duongdan_thumbnal, $duongdan_background, $trangthai, $id_danhmucgame);
                        echo "<script>
                        alert('Cập nhập danh mục thành công!');
                        window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                       </script>";
                    } else {
                        echo "<script>
                        alert('Cập nhập danh mục không thành công!');
                        window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                       </script>";
                    }
                } elseif ($_FILES['thumbnal']['name'] != "" && $_FILES['background']['name'] == "") {

                    $this->deleteImageWithoutExtension($id_danhmucgame, "./views/img/danhmucgame_thumbnal/");
                    $duongdan_thumbnal = $this->uploadImageWithCustomName("thumbnal", "./views/img/danhmucgame_thumbnal/", "$id_danhmucgame");
                    if ($duongdan_thumbnal != "loi") {
                        $kq = $this->DanhmucgameModel->updateDanhMuc($tengame, $duongdan_thumbnal, $duongdan_background, $trangthai, $id_danhmucgame);
                        echo "<script>
                            alert('Cập nhập danh mục thành công!');
                            window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                           </script>";
                    } else {
                        echo "<script>
                            alert('Cập nhập danh mục không thành công!');
                            window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                           </script>";
                    }
                } elseif ($_FILES['thumbnal']['name'] == "" && $_FILES['background']['name'] != "") {

                    $this->deleteImageWithoutExtension($id_danhmucgame, "./views/img/danhmucgame_background/");
                    $duongdan_background = $this->uploadImageWithCustomName("background", "./views/img/danhmucgame_background/", "$id_danhmucgame");
                    if ($duongdan_thumbnal != "loi") {
                        $kq = $this->DanhmucgameModel->updateDanhMuc($tengame, $duongdan_thumbnal, $duongdan_background, $trangthai, $id_danhmucgame);
                        echo "<script>
                        alert('Cập nhập danh mục thành công!');
                        window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                       </script>";
                    } else {
                        echo "<script>
                        alert('Cập nhập danh mục không thành công!');
                        window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                       </script>";
                    }
                }
            } elseif ($thaotac == "xoadanhmuc") {


                $id_danhmucgame = $_POST['id_danhmucgame'];
                $this->deleteImageWithoutExtension($id_danhmucgame, "./views/img/danhmucgame_background/");
                $this->deleteImageWithoutExtension($id_danhmucgame, "./views/img/danhmucgame_thumbnal/");

                $xoadanhmuc = $this->DanhmucgameModel->deleteDanhMuc($id_danhmucgame);
                if ($xoadanhmuc == "thanhcong") {
                    echo "<script>
                    alert('Xóa danh mục #$id_danhmucgame thành công!');
                    window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                   </script>";
                } else {
                    echo "<script>
                    alert('Xóa danh mục #$id_danhmucgame không thành công!');
                    window.location.href = './index.php?controller=admin&action=quanlydanhmuc';
                   </script>";
                }
            }
        } else {
            header('Location: ./index.php?controller=trangchu');
        }
    }

    public function quanlytaikhoan()

    {
        if ($_SESSION['capbac'] == "admin") {
            $thaotac = $_GET['thaotac'] ?? "";
            if ($thaotac == "") {
                $page = $_REQUEST['page'] ?? "1";
                $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');

                $tengame = $_GET['tengame'] ?? "";
                $tinhtrang = $_GET['tinhtrang'] ?? "";
                $id_danhmucgame = $_GET['danhmucgame'] ?? "";
                if ($tinhtrang != "") {
                    $tinhtrang = "AND taikhoangame.tinhtrang = '$tinhtrang'";
                }
                if ($id_danhmucgame != "") {
                    $id_danhmucgame = "AND danhmucgame.id_danhmucgame = '$id_danhmucgame'";
                }
                $showdanhmucgame = $this->DanhmucgameModel->getAll();
                $soluongacc = $this->TaikhoangameModel->hienThiTaiKhoanGameAdmin($tengame, $tinhtrang, $id_danhmucgame, "");
                $so_luong = count($soluongacc);
                $maxpage = ceil($so_luong / 12);
                if ($maxpage > 0) {
                    $gioihan = "ORDER BY id_taikhoangame DESC LIMIT 12 " . "OFFSET " . ($page * 12) - 12;
                } else {
                    $gioihan = "ORDER BY id_taikhoangame DESC";
                }
                $tongsotaikhoan = $this->TaikhoangameModel->tongsotaikhoan();
                $tongsotaikhoandaban = $this->TaikhoangameModel->tongsotaikhoandaban();


                $taikhoangame = $this->TaikhoangameModel->hienThiTaiKhoanGameAdmin($tengame, $tinhtrang, $id_danhmucgame, $gioihan);
                return $this->view('admin.quanlytaikhoan', [
                    'taikhoangame' => $taikhoangame,
                    'maxpage' => $maxpage,
                    'showdanhmucgame' => $showdanhmucgame,
                    'tongsotaikhoan' => $tongsotaikhoan,
                    'tongsotaikhoandaban' => $tongsotaikhoandaban,


                ]);
            } elseif ($thaotac == "themtaikhoan") {

                $motangan = $_POST['motangan'];
                $giagoc = (int)$_POST['giagoc'];
                $giamgia = (int)$_POST['giamgia'];
                $danhmucgame = $_POST['danhmucgame'];
                $motachitiet = $_POST['editor1'];
                $taikhoan = $_POST['taikhoan'];
                $matkhau = $_POST['matkhau'];
                $loaidangki = $_POST['loaidangki'];
                $tinhtrang = $_POST['tinhtrang'];
                $soanh = (int)$_POST['soanh'];




                $maxId = $this->AdminModel->selectCustoms("SELECT MAX(id_taikhoangame) FROM taikhoangame");
                $maxId = (int)$maxId[0]['MAX(id_taikhoangame)'];
                $maxId = $maxId + 1;
                $duongdan_thumbnal = $this->uploadImageWithCustomName("thumbnal", "./views/img/taikhoangame_thumbnal/", "$maxId");

                $hinhanhchitiet = "";
                for ($i = 1; $i <= $soanh; $i++) {
                    $anh = 'duongdan_anh' . $i;
                    $$anh = $this->uploadImageWithCustomName("anh$i", "./views/img/taikhoangame_hinhanhchitiet/$maxId/", "anh$i");
                    if ($$anh == "loi") {
                    } else {
                        $hinhanhchitiet = $hinhanhchitiet . ',' . $$anh;
                    }
                }
                $hinhanhchitiet = substr($hinhanhchitiet, 1);
                $kq = $this->TaikhoangameModel->themTaiKhoanGame($maxId, $taikhoan, $matkhau, $duongdan_thumbnal, $giagoc, $giamgia, $danhmucgame, $tinhtrang, $loaidangki, $motangan, $motachitiet, $hinhanhchitiet);
                if ($kq == "thanhcong") {
                    echo "<script>
                    alert('Thêm tài khoản thành công!');
                    window.location.href = './index.php?controller=admin&action=quanlytaikhoan';
                   </script>";
                } else {
                    echo "<script>
                    alert('Thêm tài khoản không thành công!');
                    window.location.href = './index.php?controller=admin&action=quanlytaikhoan';
                   </script>";
                }
            } elseif ($thaotac == "capnhaptaikhoan") {
                $id_taikhoangame = $_POST['id_taikhoangame'];
                $motangan = $_POST['motangan'];
                $giagoc = (int)$_POST['giagoc'];
                $giamgia = (int)$_POST['giamgia'];
                $danhmucgame = $_POST['danhmucgame'];
                $motachitiet = $_POST["editor$id_taikhoangame"];
                $taikhoan = $_POST['taikhoan'];
                $matkhau = $_POST['matkhau'];
                $loaidangki = $_POST['loaidangki'];
                $tinhtrang = $_POST['tinhtrang'];
                $thumbnal_cu = $_POST['thumbnal_cu'];

                //xyly thumbnal
                if ($_FILES["thumbnal"]['name'] != "") {
                    $this->xoaHinhAnhTheoDuongDan($thumbnal_cu);
                    $thumbnalmoi = $this->uploadImageWithCustomName("thumbnal", "./views/img/taikhoangame_thumbnal/", "$id_taikhoangame");
                } else {
                    $thumbnalmoi = $thumbnal_cu;
                }
                //xu ly hinhanhchitiet
                $soanh = (int)$_POST['soanh'];
                $anhbixoa = $_POST['anhbixoa'];
                $hinhanhbandau = $_POST['hinhanhbandau'];
                $manghinhanhbandau = explode(",", $hinhanhbandau);
                $manganhbixoa = explode(",", $anhbixoa);
                $manghinhanhconlai = array_diff($manghinhanhbandau, $manganhbixoa);
                $hinhanhchitiet = "";
                $sothutuanh = 1;

                foreach ($manganhbixoa as $manganhbixoas) {
                    $this->xoaHinhAnhTheoDuongDan($manganhbixoas);
                }

                foreach ($manghinhanhconlai as $manghinhanhconlais) {
                    if ($manghinhanhconlais != "") {
                        $hinhanhdadoiten = $this->doiTenFile($manghinhanhconlais, "anh$sothutuanh");
                        $sothutuanh++;
                    }
                }
                for ($i = 1; $i <= $soanh; $i++) {
                    $anh = 'duongdan_anh' . $i;
                    if ($_FILES["anh$i"]['name'] != "") {
                        $this->deleteImageWithoutExtension("anh$i", "./views/img/taikhoangame_hinhanhchitiet/$id_taikhoangame/");
                        $$anh = $this->uploadImageWithCustomName("anh$i", "./views/img/taikhoangame_hinhanhchitiet/$id_taikhoangame/", "anh$i");
                    }
                }
                $manghinhanhchitiet = $this->layDanhSachDuongDan("./views/img/taikhoangame_hinhanhchitiet/$id_taikhoangame");
                foreach ($manghinhanhchitiet as $manghinhanhchitiets) {
                    $hinhanhchitiet = $hinhanhchitiet . ',' . $manghinhanhchitiets;
                }
                $hinhanhchitiet = substr($hinhanhchitiet, 1);
                //end hinhanhchitiet

                $ketquaupdate =  $this->TaikhoangameModel->capNhapTaiKhoan($id_taikhoangame, $taikhoan, $matkhau, $thumbnalmoi, $giagoc, $giamgia, $danhmucgame, $tinhtrang, $loaidangki, $motangan, $motachitiet, $hinhanhchitiet, $tinhtrang);

                if ($ketquaupdate != "khongthanhcong") {
                    echo "<script>
                    alert('Cập nhập tài khoản thành công!');
                    window.location.href = './index.php?controller=admin&action=quanlytaikhoan';
                   </script>";
                } else {
                    echo "<script>
                    alert('Cập nhập tài khoản không thành công!');
                    window.location.href = './index.php?controller=admin&action=quanlytaikhoan';
                   </script>";
                }
            }
        } else {
            header('Location: ./index.php?controller=trangchu');
        }
    }
    public function quanlynguoidung()

    {
        if ($_SESSION['capbac'] == "admin") {
            $page = $_REQUEST['page'] ?? "1";
            $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');

            $nguoidungAll = $this->NguoidungModel->hienThiNguoiDung();
            $so_luong = count($nguoidungAll);
            $maxpage = ceil($so_luong / 12);
            $tukhoa = $_REQUEST['tukhoa'] ?? "";


            if ($maxpage > 0) {
                $gioihan = "ORDER BY id_nguoidung DESC LIMIT 12 " . "OFFSET " . ($page * 12) - 12;
            } else {
                $gioihan = "ORDER BY id_nguoidung DESC";
            }
            if ($tukhoa != "") {
                $tukhoa = "AND taikhoan LIKE '%$tukhoa%' OR sodienthoai LIKE '%$tukhoa%' OR email LIKE '%$tukhoa%'";
            }
            $nguoidungAll = $this->NguoidungModel->hienThiNguoiDung($gioihan, $tukhoa);

            return $this->view('admin.quanlynguoidung', [
                'nguoidungAll' => $nguoidungAll,
                'maxpage' => $maxpage,
                'tongsonguoidung' => $so_luong,
            ]);
        } else {
            header('Location: ./index.php?controller=trangchu');
        }
    }
    public function quanlydonhang()

    {
        if ($_SESSION['capbac'] == "admin") {
            $page = $_REQUEST['page'] ?? "1";
            $tongsodonhang = $this->DonhangModel->tongSoDonHang();
            $showdanhmucgame = $this->DanhmucgameModel->getAll();
            // $tonghoadon = $this->HoadonModel->hienThiAllHoaDon();

            $maxpage = ceil((int)$tongsodonhang / 10);
            if ($maxpage > 0) {
                $gioihan = "ORDER BY donhang.id_donhang DESC LIMIT 10 " . "OFFSET " . ($page * 10) - 10;
            } else {
                $gioihan = "ORDER BY donhang.id_donhang DESC";
            }

            $nguoimua = $_REQUEST['nguoimua'] ?? "";
            $id_taikhoangame = $_REQUEST['id_taikhoangame'] ?? "";
            $danhmucgame = $_REQUEST['danhmucgame'] ?? "";
            $ngaybatdau = $_REQUEST['ngaybatdau'] ?? "";
            $ngayketthuc = $_REQUEST['ngayketthuc'] ?? "";

            if ($nguoimua != "") {
                $nguoimua = "AND nguoidung.taikhoan LIKE '%${nguoimua}%'";
            }
            if ($id_taikhoangame != "") {
                $id_taikhoangame = "AND donhang.id_taikhoangame ='$id_taikhoangame'";
            }
            if ($danhmucgame != "") {
                $danhmucgame = "AND danhmucgame.id_danhmucgame = $danhmucgame ";
            }
            if ($ngaybatdau != "" && $ngayketthuc != "") {
                $thoigian = "AND donhang.thoigianmua BETWEEN '$ngaybatdau' AND '$ngayketthuc'";
            } elseif ($ngaybatdau != "" && $ngayketthuc == "") {

                $thoigian = "AND donhang.thoigianmua BETWEEN '$ngaybatdau' AND '0'";
            } elseif ($ngaybatdau == "" && $ngayketthuc != "") {
                $thoigian = "AND donhang.thoigianmua BETWEEN '0' AND '$ngayketthuc'";
            } elseif ($ngaybatdau == null && $ngaybatdau == null) {
                $thoigian = "";
            }

            $donhang = $this->DonhangModel->tatCaDonHang($nguoimua, $id_taikhoangame, $danhmucgame, $thoigian, $gioihan);
            $maxpage = ceil((count($donhang) / 10));
            return $this->view('admin.quanlydonhang', [
                'sodonhang' => $tongsodonhang[0]['tongsodonhang'],
                'donhang' => $donhang,
                'maxpage' => $maxpage,
                'showdanhmucgame' => $showdanhmucgame,
            ]);
        } else {
            header('Location: ./index.php?controller=trangchu');
        }
    }
    public function thongke()

    {
        if ($_SESSION['capbac'] == "admin") {
            $tongdoanhthu = $this->AdminModel->tongDoanhthu();
            $tongdonhang = $this->AdminModel->tongdonhang();
            return $this->view('admin.thongke', [
                'tongdoanhthu'=>$tongdoanhthu[0]['SUM(giatien)'],
                'tongdonhang'=>$tongdonhang[0]['COUNT(*)'],

            ]);
        } else {
            header('Location: ./index.php?controller=trangchu');
        }
    }
    public function xulythongke()
    {
        $thaotac = $_REQUEST['thaotac'] ?? "";
        if ($thaotac == "thongkedoanhthu") {
            $ngaythang = $_POST['date'];
            $ngaythang = array_map('trim', explode(",", $ngaythang));
            $doanhthu = "";
            foreach ($ngaythang as $ngaythangs) {
                $data = $this->AdminModel->thongKeDoanhThu($ngaythangs);
                if ($data[0]['SUM(giatien)'] == "") {
                    $doanhthungay = "0";
                } else {
                    $doanhthungay = $data[0]['SUM(giatien)'];
                }
                $doanhthu = $doanhthu . "," . $doanhthungay;
            }
            $doanhthu = substr($doanhthu, 1);

            echo $doanhthu;
        } elseif ($thaotac == "thongkedoanhthutheonam") {
            $ngaythang = $_POST['date'];
            $ngaythang = array_map('trim', explode(",", $ngaythang));
            $doanhthu = "";
            foreach ($ngaythang as $ngaythangs) {
                $data = $this->AdminModel->thongKeDoanhThu_TheoNam($ngaythangs);
                if ($data[0]['SUM(giatien)'] == "") {
                    $doanhthungay = "0";
                } else {
                    $doanhthungay = $data[0]['SUM(giatien)'];
                }
                $doanhthu = $doanhthu . "," . $doanhthungay;
            }
            $doanhthu = substr($doanhthu, 1);

            echo $doanhthu;
        }else if ($thaotac == "thongkedonhang") {
            $ngaythang = $_POST['date'];
            $ngaythang = array_map('trim', explode(",", $ngaythang));
            $doanhthu = "";
            foreach ($ngaythang as $ngaythangs) {
                $data = $this->AdminModel->thongKeDonHang($ngaythangs);
                if ($data[0]['COUNT(*)'] == "") {
                    $doanhthungay = "0";
                } else {
                    $doanhthungay = $data[0]['COUNT(*)'];
                }
                $doanhthu = $doanhthu . "," . $doanhthungay;
            }
            $doanhthu = substr($doanhthu, 1);

            echo $doanhthu;
        } elseif ($thaotac == "thongkedonhangtheonam") {
            $ngaythang = $_POST['date'];
            $ngaythang = array_map('trim', explode(",", $ngaythang));
            $doanhthu = "";
            foreach ($ngaythang as $ngaythangs) {
                $data = $this->AdminModel->thongKeDonHang_TheoNam($ngaythangs);
                if ($data[0]['COUNT(*)'] == "") {
                    $doanhthungay = "0";
                } else {
                    $doanhthungay = $data[0]['COUNT(*)'];
                }
                $doanhthu = $doanhthu . "," . $doanhthungay;
            }
            $doanhthu = substr($doanhthu, 1);

            echo $doanhthu;
        }
    }
    public function caidat()

    {
        if ($_SESSION['capbac'] == "admin") {
            $thaotac = $_REQUEST['thaotac'] ?? "";
            $caidat = $this->AdminModel->tatCaCaiDat();
            $vnpay = $this->AdminModel->caiDatVnpay();
            $momo = $this->AdminModel->caidatmomo();

            if ($thaotac == "giaodienvathongbao") {

                $tentrangweb = $_POST['tentrangweb'] ?? "";
                $thongbao = $_POST['thongbao'] ?? "";
                if ($_FILES["anhbia"]['name'] != "") {
                    $this->deleteImageWithoutExtension("anhbia", "./views/img/setting/");
                    $anhbia = $this->uploadImageWithCustomName("anhbia", "./views/img/setting/", "anhbia");
                } else {
                    $anhbia = $caidat[0]['anhbia'];
                }
                if ($_FILES["logo"]['name'] != "") {
                    $this->deleteImageWithoutExtension("logo", "./views/img/setting/");
                    $logo = $this->uploadImageWithCustomName("logo", "./views/img/setting/", "logo");
                } else {
                    $logo = $caidat[0]['logo'];
                }
                $this->AdminModel->capNhapCaiDat($tentrangweb, $thongbao, $anhbia, $logo);
                header("Location: ./index.php?controller=admin&action=caidat");
            }elseif ($thaotac == "lienhe") {

                $lienhe = $_POST['editor1'] ?? "";
                $this->AdminModel->capNhapLienHe($lienhe);
                header("Location: ./index.php?controller=admin&action=caidat");

            } elseif ($thaotac == "plugin") {
                $plugin = $_POST['plugin'] ?? "";
                $this->AdminModel->capNhapPlugin($plugin);
                header("Location: ./index.php?controller=admin&action=caidat");
            } elseif ($thaotac == "vnpay") {
                $terminal_id = $_POST['terminal_id'] ?? "";
                $secret_key = $_POST['secret_key'] ?? "";
                $this->AdminModel->capNhapVnpay($terminal_id, $secret_key);
                header("Location: ./index.php?controller=admin&action=caidat");
            } elseif ($thaotac == "momo") {
                $partnercode = $_POST['partnercode'] ?? "";
                $accesskey = $_POST['accesskey'] ?? "";
                $secretkey = $_POST['secretkey'] ?? "";
                $this->AdminModel->capNhapMomo($partnercode, $accesskey, $secretkey);
                header("Location: ./index.php?controller=admin&action=caidat");
            } elseif ($thaotac == "trangthai") {
                $trangthai = $_POST['trangthai'] ?? "";

                $this->AdminModel->capNhapTrangthai($trangthai);
                header("Location: ./index.php?controller=admin&action=caidat");
            }

            return $this->view('admin.caidat', [
                'caidat' => $caidat[0],
                'lienhe' =>$caidat[0]['lienhe'],
                'vnpay' => $vnpay[0],
                'momo' => $momo[0],

            ]);
        } else {
            header('Location: ./index.php?controller=trangchu');
        }
    }
}
