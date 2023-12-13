<?php

class TaikhoangameController extends BaseController
{
    private $TaikhoangameModel;
    private $DanhmucgameModel;
    private $NguoidungModel;
    private $DonhangModel;
    public function __construct()
    {
        // load file model
        $this->loadModel('TaikhoangameModel');
        $this->TaikhoangameModel = new TaikhoangameModel;
        $this->loadModel('DanhmucgameModel');
        $this->DanhmucgameModel = new DanhmucgameModel;
        $this->loadModel('NguoidungModel');
        $this->NguoidungModel = new NguoidungModel;
        $this->loadModel('DonhangModel');
        $this->DonhangModel = new DonhangModel;
    }

    public function index()
    {

        $id_danhmucgame = $_REQUEST['iddanhmucgame'] ?? null;
        $id_taikhoangame = $_REQUEST['idtaikhoangame'] ?? null;

        $taikhoangame =  $this->TaikhoangameModel->hienThiTaiKhoan($id_taikhoangame);
        $tengame = $this->DanhmucgameModel->getThumbnal($id_danhmucgame);


        return $this->view(
            'taikhoangame.index',
            [
                'taikhoangame' => $taikhoangame[0],
                'id_danhmucgame' => $id_danhmucgame,
                'tengame' => $tengame[0]['tengame'],

            ]
        );
    }
   
}
