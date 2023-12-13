<?php

class DangnhapController extends BaseController
{
    private $dangnhapModel;
    public function __construct()
    {
        // load file model
        $this->loadModel('DangnhapModel');
        $this->dangnhapModel = new DangnhapModel;
    }

    public function index()

    {
        return $this->view('dangnhap.index');
    }
    public function login()
    {

        if (!isset($_SESSION['taikhoan'])) {
            $username = $_GET['username'] ?? null;
            $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

            $password = $_GET['password'] ?? null;
            $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

            $taikhoan = $this->dangnhapModel->login($username, $password);
            if ($taikhoan != null) {
                foreach ($taikhoan[0] as $key => $value) {
                    $_SESSION[$key] = $value;
                }
                header("Location: .");
            } else {
                $thongbao = "Sai tài khoản hoặc mật khẩu!";
                return $this->view('dangnhap.index', [
                    'thongbao' => $thongbao,
                ]);
            }
        } else {
            header("Location: .");
        }
    }
    public function logout()
    {
        session_unset();
        header("Location: .");
    }
}
