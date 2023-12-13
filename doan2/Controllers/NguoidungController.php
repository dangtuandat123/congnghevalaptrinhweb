<?php

class NguoidungController extends BaseController
{
    private $nguoidungModel;

    public function __construct()
    {
        // load file model
        $this->loadModel('NguoidungModel');
        $this->nguoidungModel = new NguoidungModel;
    }

    public function index()

    {
        header('Location: ./index.php?controller=nguoidung&action=thongtinnguoidung');
    }
    public function thongtinnguoidung()

    {
        $id_nguoidung = $_SESSION['id_nguoidung'];

        $nguoidung =  $this->nguoidungModel->getUser($id_nguoidung);

        return $this->view('nguoidung.thongtinnguoidung', [
            'nguoidung' => $nguoidung[0],

        ]);
    }
    public function capnhapthongtinnguoidung()
    {
        $sodienthoai = $_REQUEST['sodienthoai'] ?? null;
        $sodienthoai = htmlspecialchars($sodienthoai, ENT_QUOTES, 'UTF-8');

        $email = $_REQUEST['email'] ?? null;
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

        $id_nguoidung = $_SESSION['id_nguoidung'];
        $this->nguoidungModel->updateThongTinNguoiDung($sodienthoai, $email, $id_nguoidung);

        $nguoidung =  $this->nguoidungModel->getUser($id_nguoidung);

        return $this->view('nguoidung.thongtinnguoidung', [
            'nguoidung' => $nguoidung[0],

        ]);
    }
    public function doimatkhau()
    {
        $matkhaucu = $_REQUEST['matkhaucu'] ?? null;
        $matkhaucu = htmlspecialchars($matkhaucu, ENT_QUOTES, 'UTF-8');

        $matkhaumoi = $_REQUEST['matkhaumoi'] ?? null;
        $matkhaumoi = htmlspecialchars($matkhaumoi, ENT_QUOTES, 'UTF-8');

        $id_nguoidung = $_SESSION['id_nguoidung'];
        $matkhaukiemtra = $this->nguoidungModel->kiemTraMatKhau($id_nguoidung);

        if ($matkhaukiemtra[0]['matkhau'] == $matkhaucu) {

            $this->nguoidungModel->upadateMatKhau($matkhaumoi, $id_nguoidung);

            $nguoidung =  $this->nguoidungModel->getUser($id_nguoidung);

            return $this->view('nguoidung.thongtinnguoidung', [
                'nguoidung' => $nguoidung[0],
                'color' => 'green',
                'thongbao' => 'Đổi mật khẩu thành công!',

            ]);
        } else {
            $nguoidung =  $this->nguoidungModel->getUser($id_nguoidung);
            return $this->view('nguoidung.thongtinnguoidung', [
                'nguoidung' => $nguoidung[0],
                'color' => 'red',
                'thongbao' => 'Đổi mật khẩu không thành công!',

            ]);
        }
    }
    public function lichsumuahang()

    {
        $page = $_REQUEST['page'] ?? "1";
        $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');

        $maso = $_REQUEST['maso'] ?? "";
        $maso = htmlspecialchars($maso, ENT_QUOTES, 'UTF-8');

        $giatien = $_REQUEST['giatien'] ?? "";
        $giatien = htmlspecialchars($giatien, ENT_QUOTES, 'UTF-8');

        $tungay = $_REQUEST['tungay'] ?? "";
        $tungay = htmlspecialchars($tungay, ENT_QUOTES, 'UTF-8');

        $denngay = $_REQUEST['denngay'] ?? "";
        $denngay = htmlspecialchars($denngay, ENT_QUOTES, 'UTF-8');


        if ($maso != null) {
            $maso = "AND taikhoangame.id_taikhoangame = $maso";
        }

        if ($giatien != null) {
            $giatien = "AND CAST(taikhoangame.giatien - (taikhoangame.giatien * taikhoangame.giamgia / 100) AS SIGNED) $giatien";
        }

        if ($tungay != null && $denngay != null) {
            $loctheongay = "AND donhang.thoigianmua BETWEEN '$tungay' AND '$denngay'";
        } elseif ($tungay == null && $denngay != null) {
            $loctheongay = "AND donhang.thoigianmua BETWEEN '0' AND '$denngay'";
        } elseif ($tungay != null && $denngay == null) {
            $loctheongay = "AND donhang.thoigianmua BETWEEN '$tungay' AND '0'";
        } elseif ($tungay == null && $denngay == null) {
            $loctheongay = "";
        }
        $gioihan = "LIMIT 6 " . "OFFSET " . ($page * 6) - 6;

        $id_nguoidung = $_SESSION['id_nguoidung'];

        $soluongacc =  $this->nguoidungModel->showTaiKhoanDaMua($id_nguoidung, "", $maso, $giatien, $loctheongay);
        $so_luong = count($soluongacc);
        $maxpage = ceil($so_luong / 6);

        if ($maxpage > 0) {

            $gioihan = "LIMIT 6 " . "OFFSET " . ($page * 6) - 6;
        } else {
            $gioihan = "";
        }

        $lichsudonhang =  $this->nguoidungModel->showTaiKhoanDaMua($id_nguoidung, $gioihan, $maso, $giatien, $loctheongay);
        // $so_luong = count($lichsudonhang);
        // $maxpage = ceil($so_luong / 6);
        return $this->view('nguoidung.lichsumuahang', [
            'lichsudonhang' => $lichsudonhang,
            'maxpage' => $maxpage,


        ]);
    }
    public function lichsunaptien()

    {

        $id_nguoidung = $_SESSION['id_nguoidung'];
        $loainaptien = $_REQUEST['loainaptien'] ?? "atm";
        $loainaptien = htmlspecialchars($loainaptien, ENT_QUOTES, 'UTF-8');

        if ($loainaptien == "atm") {
            $nganhang = $_REQUEST['nganhang'] ?? "";
            $nganhang = htmlspecialchars($nganhang, ENT_QUOTES, 'UTF-8');

            $tungay = $_REQUEST['tungay'] ?? "";
            $tungay = htmlspecialchars($tungay, ENT_QUOTES, 'UTF-8');

            $denngay = $_REQUEST['denngay'] ?? "";
            $denngay = htmlspecialchars($denngay, ENT_QUOTES, 'UTF-8');

            if ($nganhang != null) {
                $nganhang = "AND nganhang = '$nganhang'";
            }

            if ($tungay != null && $denngay != null) {
                $loctheongay = "AND ngaynaptien BETWEEN '$tungay' AND '$denngay'";
            } elseif ($tungay == null && $denngay != null) {
                $loctheongay = "AND ngaynaptien BETWEEN '0' AND '$denngay'";
            } elseif ($tungay != null && $denngay == null) {
                $loctheongay = "AND ngaynaptien BETWEEN '$tungay' AND '0'";
            } elseif ($tungay == null && $denngay == null) {
                $loctheongay = "";
            }

            $lichSuNapTienAtm =  $this->nguoidungModel->lichSuNapTienAtm($id_nguoidung, $nganhang, $loctheongay);

            // print_r($lichSuNapTienAtm);
            // die();

            return $this->view('nguoidung.lichsunaptien', [
                'lichSuNapTienAtm' => $lichSuNapTienAtm,
                'loainaptien' => $loainaptien,

            ]);
        } else {
            $lichSuNapTienCard =  $this->nguoidungModel->lichSuNapTienCard($id_nguoidung);
            // print_r($lichSuNapTienCard);
            // die();
            return $this->view('nguoidung.lichsunaptien', [
                'lichSuNapTienCard' => $lichSuNapTienCard,
                'loainaptien' => $loainaptien,

            ]);
        }
    }

    public function caidattaikhoan()

    {
        $nguoidung =  $this->nguoidungModel->getAll();

        return $this->view('nguoidung.index', [
            'nguoidung' => $nguoidung,


        ]);
    }
}
