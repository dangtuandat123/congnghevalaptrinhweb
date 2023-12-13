<?php

class DangkiController extends BaseController
{
    private $dangkiModel;
    public function __construct()
    {
        // load file model
        $this->loadModel('DangkiModel');
        $this->dangkiModel = new DangkiModel;
    }

    public function index()

    {
        return $this->view('dangki.index');
    }
    public function dangki()
    {
        if (!isset($_SESSION['taikhoan'])) {

            $username = $_GET['username'] ?? null;
            $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

            $password = $_GET['password'] ?? null;
            $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

            $repassword = $_GET['repassword'] ?? null;
            $repassword = htmlspecialchars($repassword, ENT_QUOTES, 'UTF-8');

            if ($username == null || $password == null || $repassword == null) {
                $thongbao = "";
                return $this->view('dangki.index', [
                    'thongbao' => $thongbao,
                    'color' => 'green',
                ]);
            }
            if (isset($_GET['g-recaptcha-response']) && !empty($_GET['g-recaptcha-response'])) {
                $secret = '6LfhEC8pAAAAAHi-DT80dM7UGCXYCk0992a5b26A'; //Thay thế bằng mã Secret Key của bạn
                $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_GET['g-recaptcha-response']);
                $response_data = json_decode($verify_response);
                if ($response_data->success) {
                    if ($password == $repassword) {
                        $dangki = $this->dangkiModel->dangki($username, $password);
                        if ($dangki == 'thanhcong') {
                            $thongbao = "Đăng kí thành công, vui lòng đăng nhập!";
                            return $this->view('dangnhap.index', [
                                'thongbao' => $thongbao,
                                'color' => 'green',
                            ]);
                        } else {
                            $thongbao = "Tài khoản đã tồn tại!";
                            return $this->view('dangki.index', [
                                'thongbao' => $thongbao,
                                'color' => 'red',
                            ]);
                        }
                    } else {
                        $thongbao = "Nhập lại mật mật không đúng!";
                        return $this->view('dangki.index', [
                            'thongbao' => $thongbao,
                            'color' => 'red',
                        ]);
                    }
                } else {
                    $thongbao = "Chưa xác thực capcha!";
                    return $this->view('dangki.index', [
                        'thongbao' => $thongbao,
                        'color' => 'red',
                    ]);
                }
            } else {
                $thongbao = "Chưa xác thực capcha!";
                return $this->view('dangki.index', [
                    'thongbao' => $thongbao,
                    'color' => 'red',
                ]);
            }
        } else {
            header("Location: .");
        }
    }
}
