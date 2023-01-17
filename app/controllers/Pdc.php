<?php

class Pdc extends BaseController
{
    
    public function __construct()
    {
        $this->pdcModel = $this->model('Pdc');
    }

    public function index() //default method and view
    {
        $this->view('pdc/login');
    }

<<<<<<< HEAD
    
=======
    public function addUsers(){
        
    }


>>>>>>> 4eb739667e5b1599d4cbd087c8bf2190218b0129
}
