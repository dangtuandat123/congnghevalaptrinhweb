<?php

class LienheController extends BaseController
{
   
    
    private $AdminModel;
    public function __construct()
    {
      
        $this->loadModel('AdminModel');
        $this->AdminModel = new AdminModel;

    }
   
    public function index()

    {
       
        $lienhe = $this ->AdminModel->tatCaCaiDat();

        return $this->view('lienhe.index', [
           'lienhe' => $lienhe[0]['lienhe'],

        ]);
    }
   
}
