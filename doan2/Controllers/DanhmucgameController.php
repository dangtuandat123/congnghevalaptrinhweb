<?php

class DanhmucgameController extends BaseController
{
    private $danhmucgameModel;
    private $taikhoangameModel;
    public function __construct()
    {
        // load file model
        $this->loadModel('DanhmucgameModel');
        $this->danhmucgameModel = new DanhmucgameModel;

        $this->loadModel('TaikhoangameModel');
        $this->taikhoangameModel = new TaikhoangameModel;
    }

    public function index()

    {

        $danhmucgame =  $this->danhmucgameModel->hienThiDanhMucGame();
        return $this->view('danhmucgame.index', [
            'danhmucgame' => $danhmucgame,
        ]);
    }
    public function timkiem()
    {
        $tukhoa = $_REQUEST['tukhoa'] ?? null;
        $danhmucgame =  $this->danhmucgameModel->timkiem($tukhoa);
        return $this->view('danhmucgame.index', [
            'danhmucgame' => $danhmucgame,
        ]);
    }
    public function loctaikhoan()
    {

        $id_danhmucgame = $_REQUEST['iddanhmucgame'] ?? null;
        $maso = $_REQUEST['maso'] ?? null;
        if ($maso != null) {
            $maso = "AND id_taikhoangame = $maso";
        }
        $giatien = $_REQUEST['giatien'] ?? "";
        if ($giatien != null) {
            $giatien = "AND (giatien - ((giatien * giamgia)/100)) $giatien";
        }
        $loaidangki = $_REQUEST['loaidangki'] ?? null;
        if ($loaidangki != null) {
            $loaidangki = "AND loaidangki = '$loaidangki'";
        }
        $sapxeptheo = $_REQUEST['sapxeptheo'] ?? null;
        if ($sapxeptheo != null) {
            if ($sapxeptheo == "giatuthapdencao") {
                $sapxeptheo = "ORDER BY (giatien - ((giatien * giamgia)/100)) ASC";
            } else if ($sapxeptheo == "giatucaodenthap") {
                $sapxeptheo = "ORDER BY (giatien - ((giatien * giamgia)/100)) DESC";
            } else if ($sapxeptheo == "giamgia") {
                $sapxeptheo = "ORDER BY giamgia DESC";
            }
        }
        //
        $soluongacc =  $this->taikhoangameModel->loctaikhoan($id_danhmucgame, $maso, $loaidangki, $giatien, $sapxeptheo);
        $soluongacc =(int) count($soluongacc);
        $page = $_REQUEST['page'] ?? "1";
        $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');

        $maxpage = ceil($soluongacc / 10);
        // echo $maxpage;
        // die();
        if ($maxpage > 0) {

            $gioihan = "LIMIT 12 " . "OFFSET " . ($page * 12) - 12;
        } else {
            $gioihan = "";
        }
        //
        $thumbnal = $this->danhmucgameModel->getThumbnal($id_danhmucgame);
        $taikhoangame =  $this->taikhoangameModel->loctaikhoan($id_danhmucgame, $maso, $loaidangki, $giatien, $sapxeptheo,$gioihan);

        return $this->view('danhmucgame.show', [
            'taikhoangame' => $taikhoangame,
            'thumbnal' => $thumbnal[0]['img_background'],
            'tengame' => $thumbnal[0]['tengame'],
            'id_danhmucgame' => $id_danhmucgame,
            'maxpage' => $maxpage,

        ]);
    }
    public function show()
    {
        $page = $_REQUEST['page'] ?? "1";
        $page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');
        $id_danhmucgame = $_REQUEST['iddanhmucgame'] ?? null;
        $soluongacc = $this->taikhoangameModel->soLuongTaiKhoan($id_danhmucgame);
        $so_luong = $soluongacc[0]['COUNT(*)'];
        $maxpage = ceil($so_luong / 12);

        if ($maxpage > 0) {

            $gioihan = "ORDER BY id_taikhoangame DESC LIMIT 12 " . "OFFSET " . ($page * 12) - 12;
        } else {
            $gioihan = "ORDER BY id_taikhoangame DESC";
        }

        $thumbnal = $this->danhmucgameModel->getThumbnal($id_danhmucgame);
        $taikhoangame =  $this->taikhoangameModel->hienThiAllNick($id_danhmucgame, $gioihan);

        return $this->view('danhmucgame.show', [
            'taikhoangame' => $taikhoangame,
            'thumbnal' => $thumbnal[0]['img_background'],
            'tengame' => $thumbnal[0]['tengame'],
            'id_danhmucgame' => $id_danhmucgame,
            'maxpage' => $maxpage,
        ]);
    }
   
}
