<?php

class ErrorController extends BaseController
{
    public function __construct()
    {
       

    }
   
    public function index()

    {
       
    
        return $this->view('error.index', [
        ]);
    }

}
