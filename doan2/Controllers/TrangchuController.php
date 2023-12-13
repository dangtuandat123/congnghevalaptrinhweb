<?php

class TrangchuController extends BaseController
{
    private $trangchuModel;
    private $danhmucgame;
    
    private $AdminModel;
    public function __construct()
    {
        // load file model
        $this->loadModel('TrangchuModel');
        $this->trangchuModel = new TrangchuModel;

        $this->loadModel('DanhmucgameModel');
        $this->danhmucgame = new DanhmucgameModel;

        $this->loadModel('AdminModel');
        $this->AdminModel = new AdminModel;

    }
   
    public function index()

    {
        $danhmucgame =  $this->danhmucgame->hienThiDanhMucGame();
        $setting = $this ->AdminModel->tatCaCaiDat();

    
        return $this->view('trangchu.index', [
            'danhmucgame' => $danhmucgame,
            'anhbia'=>$setting[0]['anhbia'],
            'thongbao'=>$setting[0]['thongbao'],

        ]);
    }
    public function show()
    {
        
        $danhmuc2 =  $this->trangchuModel->getAll();
        return $this ->view('danhmuc.show',[
            'danhmuc2' => $danhmuc2,
            ]);

    }
}
