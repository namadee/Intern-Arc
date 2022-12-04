<?php

class Company extends BaseController
{
    public $companyNavbar;
    public function __construct()
    {
        $this->companyModel = $this->model('company');
    }

    public function index() //default method and view
    {
        $this->view('company/login');
    }

}
