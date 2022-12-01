<?php

class Pdc extends BaseController
{
    public $pdcNavbar;
    public function __construct()
    {
        $this->pdcModel = $this->model('Pdc');
    }

    public function index() //default method and view
    {
        $this->view('pdc/login');
    }


}
